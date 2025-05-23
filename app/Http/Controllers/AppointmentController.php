<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Paramètres de filtrage (mois, année et jour)
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $day = $request->input('day', Carbon::today()->day); // Par défaut, on utilise le jour actuel

        // Récupérer les rendez-vous pour le mois et le jour
        $appointmentsQuery = Appointment::whereMonth('date_appointment', $month)
            ->whereYear('date_appointment', $year)
            ->whereDay('date_appointment', $day);

        // Ajouter un tri sur l'heure de début
        $appointments = $appointmentsQuery->orderBy('start_time')->get(); // Tri par heure de début

        // Calculer les jours du mois
        $currentMonth = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentMonth->daysInMonth;
        $daysOfMonth = collect(range(1, $daysInMonth)); // Tableau des jours du mois

        // Navigation vers le mois précédent et suivant
        $previousMonth = $currentMonth->copy()->subMonth()->month;
        $previousYear = $currentMonth->copy()->subMonth()->year;
        $nextMonth = $currentMonth->copy()->addMonth()->month;
        $nextYear = $currentMonth->copy()->addMonth()->year;

        return view('dashboard.appointment.list_appointment', compact('appointments', 'currentMonth', 'daysOfMonth', 'previousMonth', 'previousYear', 'nextMonth', 'nextYear', 'day'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.appointment.create_appointment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_appointment' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time', // L'heure de fin doit être après l'heure de début
        ]);

        Appointment::create([
            'date_appointment' => $request->date_appointment,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('appointment')->with('success', 'Le créneau a été créé  avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show(Request $request)
    {
        $today = Carbon::today();
        $month = $request->input('month', $today->month);
        $year = $request->input('year', $today->year);
        $day = $request->input('day', $today->day);

        // Bloquer l'accès aux mois passés
        if ($year < $today->year || ($year == $today->year && $month < $today->month)) {
            return redirect()->route('appointment.show'); // Redirige vers le mois en cours
        }

        // Récupérer les rendez-vous pour le mois/année
        $appointmentsQuery = Appointment::where('availability', 'free')
            ->whereMonth('date_appointment', $month)
            ->whereYear('date_appointment', $year);

        if ($day) {
            $appointmentsQuery->whereDay('date_appointment', $day);
        }

        $appointments = $appointmentsQuery->orderBy('start_time')->get();

        // Construction des jours du mois (filtrés si mois en cours)
        $currentMonth = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentMonth->daysInMonth;

        $startDay = ($month == $today->month && $year == $today->year) ? $today->day : 1;
        $daysOfMonth = collect(range($startDay, $daysInMonth));

        // Pas de mois précédent si on est sur le mois/année actuels
        $previousMonth = null;
        $previousYear = null;
        if (!($month == $today->month && $year == $today->year)) {
            $previousMonth = $currentMonth->copy()->subMonth()->month;
            $previousYear = $currentMonth->copy()->subMonth()->year;
        }

        $nextMonth = $currentMonth->copy()->addMonth()->month;
        $nextYear = $currentMonth->copy()->addMonth()->year;

        return view('dashboard.appointment.take_appointment', compact(
            'appointments',
            'currentMonth',
            'daysOfMonth',
            'previousMonth',
            'previousYear',
            'nextMonth',
            'nextYear',
            'day'
        ));
    }



    public function reserve($id)
    {
        // Récupère le rendez-vous
        $appointment = Appointment::find($id); // Notez le singulier

        // Récupère l'utilisateur connecté
        $user = auth()->user();

        if ($user) {
            User::where('id', $user->id)->update(['status' => 'pending']);
        }

        // Réserve le créneau pour l'utilisateur
        $appointment->user_id = $user->id;
        $appointment->availability = 'reserved'; // Change l'état du rendez-vous
        $appointment->save();

        // On récupère la date de l'appointment pour déterminer le mois, l'année, et les jours
        $currentMonth = \Carbon\Carbon::parse($appointment->date_appointment);
        $previousMonth = $currentMonth->copy()->subMonth()->month;
        $previousYear = $currentMonth->copy()->subMonth()->year;
        $nextMonth = $currentMonth->copy()->addMonth()->month;
        $nextYear = $currentMonth->copy()->addMonth()->year;
        $day = $currentMonth->day;

        // Récupère tous les jours du mois courant
        $daysOfMonth = range(1, $currentMonth->daysInMonth); // Génère les jours du mois

        // Récupère les rendez-vous pour ce jour-là
        $appointments = Appointment::whereDate('date_appointment', $currentMonth->format('Y-m-d'))
            ->where('availability', 'available')
            ->get();

        return redirect()->route('appointment.show', compact(
            'appointments',
            'currentMonth',
            'daysOfMonth',
            'previousMonth',
            'previousYear',
            'nextMonth',
            'nextYear',
            'day'
        ))->with('success', 'Votre rendez-vous a été réservé avec succès.');
    }


    public function reservedAppointment(Request $request)
    {
        // Paramètres de filtrage (mois, année et jour)
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $day = $request->input('day', Carbon::today()->day); // Par défaut, on utilise le jour actuel
    
        // Récupérer les rendez-vous réservés pour le mois et le jour
        $appointmentsQuery = Appointment::where('availability', 'reserved')
            ->whereMonth('date_appointment', $month)
            ->whereYear('date_appointment', $year)
            ->whereDay('date_appointment', $day);
    
        // Ajouter un tri sur l'heure de début
        $appointments = $appointmentsQuery->orderBy('start_time')->get();
    
        // Calculer les jours du mois pour l'affichage du calendrier
        $currentMonth = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentMonth->daysInMonth;
        $daysOfMonth = collect(range(1, $daysInMonth));
    
        // Navigation entre mois
        $previousMonth = $currentMonth->copy()->subMonth()->month;
        $previousYear = $currentMonth->copy()->subMonth()->year;
        $nextMonth = $currentMonth->copy()->addMonth()->month;
        $nextYear = $currentMonth->copy()->addMonth()->year;
    
        return view('dashboard.appointment.reservred_appointment', compact(
            'appointments',
            'currentMonth',
            'daysOfMonth',
            'previousMonth',
            'previousYear',
            'nextMonth',
            'nextYear',
            'day'
        ));
    }
    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('dashboard.appointment.edit_appointment', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Validation des données
        $request->validate([
            'date_appointment' => 'required|date',
            'start_time' => 'required|',
            'end_time' => 'required|after:start_time',
            'availability' => 'required|in:free,reserved,unavailable',
        ]);

        $appointment->fill($request->all())->save();
        return redirect()->route('appointment')->with('success', 'Le créneau a été mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Le créneau a été supprimé avec succès !');
    }
    public function myAppointments()
    {
        $user = auth()->user(); // L'utilisateur connecté

        // On récupère ses rendez-vous réservés
        $appointments = Appointment::where('user_id', $user->id)
            ->with('user') // Relation avec l'utilisateur (utile pour afficher les infos)
            ->orderBy('date_appointment', 'asc')
            ->get();

        return view('dashboard.appointment.my_appointment', compact('appointments', 'user'));
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);


        if ($appointment->user) {
            $user = $appointment->user;
            $user->status = 'canceled';
            $user->save();
        }

        // Annulation du rendez-vous : remise à disposition
        $appointment->user_id = null;
        $appointment->availability = 'free';
        $appointment->save();

        return redirect()->back()->with('success', 'Le rendez-vous a été annulé avec succès.');
    }
}

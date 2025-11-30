    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PatientController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\EducationController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\TelenursingController;
    use App\Http\Controllers\QuestionnaireController;
    use App\Http\Controllers\QuestionAnswerController;
    use App\Http\Controllers\MedicationScheduleController;

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['auth', 'verified', 'role:superadmin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });

    Route::middleware(['auth', 'verified', 'role:superadmin|perawat'])->group(function () {
        //dasbboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('patient', PatientController::class);
        Route::resource('educations', EducationController::class);
        Route::get('telenursing', [TelenursingController::class, 'index'])->name('telenursing.index');
        Route::post('telenursing', [TelenursingController::class, 'update'])->name('telenursing.update');

        // Questionnaire
        Route::get('questionnaire', [QuestionnaireController::class, 'index'])->name('questionnaire.index');

        // Questions
        Route::get('questionnaire/questions/create', [QuestionnaireController::class, 'createQuestion'])->name('questionnaire.questions.create');
        Route::post('questionnaire/questions', [QuestionnaireController::class, 'storeQuestion'])->name('questionnaire.questions.store');
        Route::get('questionnaire/questions/{question}/edit', [QuestionnaireController::class, 'editQuestion'])->name('questionnaire.questions.edit');
        Route::put('questionnaire/questions/{question}', [QuestionnaireController::class, 'updateQuestion'])->name('questionnaire.questions.update');
        Route::delete('questionnaire/questions/{question}', [QuestionnaireController::class, 'destroyQuestion'])->name('questionnaire.questions.destroy');

        // Options
        Route::get('questionnaire/options/create', [QuestionnaireController::class, 'createOption'])->name('questionnaire.options.create');
        Route::post('questionnaire/options', [QuestionnaireController::class, 'storeOption'])->name('questionnaire.options.store');
        Route::get('questionnaire/options/{option}/edit', [QuestionnaireController::class, 'editOption'])->name('questionnaire.options.edit');
        Route::put('questionnaire/options/{option}', [QuestionnaireController::class, 'updateOption'])->name('questionnaire.options.update');
        Route::delete('questionnaire/options/{option}', [QuestionnaireController::class, 'destroyOption'])->name('questionnaire.options.destroy');

        // Question Answers
        Route::get('questionanswer', [QuestionAnswerController::class, 'index'])->name('question_answer.index');
        Route::get('questionanswer/{result}', [QuestionAnswerController::class, 'show'])->name('question_answer.show');

        // Jadwal Obat
        Route::get('medication-schedules', [MedicationScheduleController::class, 'index'])->name('medication.schedules.index');
        Route::get('medication-schedules/create', [MedicationScheduleController::class, 'create'])->name('medication.schedules.create');
        Route::post('medication-schedules', [MedicationScheduleController::class, 'store'])->name('medication.schedules.store');
        Route::get('medication-schedules/{schedule}', [MedicationScheduleController::class, 'show'])->name('medication.schedules.show');
        Route::post('medication-schedules/{medication_schedule}/cancel', [MedicationScheduleController::class, 'cancel'])->name('medication.schedules.cancel');
        Route::delete('medication-schedules/{medication_schedule}', [MedicationScheduleController::class, 'destroy'])->name('medication.schedules.destroy');
    });

    require __DIR__ . '/auth.php';

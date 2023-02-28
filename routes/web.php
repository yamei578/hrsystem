<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\Department;
use App\Models\Job;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function(){
   // Route::get('/admin', 'App\Http\Controllers\AdminsController@index')->name('admin.index');

   Route::get('admin/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');

});




Route::middleware('role:admin')->group(function(){

//USERS

    Route::put('admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    Route::put('admin/users/{user}/attach','App\Http\Controllers\UserController@attach')->name('users.role.attach');

    Route::put('admin/users/{user}/detach','App\Http\Controllers\UserController@detach')->name('users.role.detach');
  
    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');

    Route::get('admin/users/updatepassword/{user}', 'App\Http\Controllers\UserController@indexPassword')->name('users.password.index');
    Route::put('admin/users/{user}/updatepassword', 'App\Http\Controllers\UserController@updatePassword')->name('user.update.password');
  

    Route::delete('admin/users/{user}/destroy', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');


    Route::put('admin/users/{id}/inactivar', 'App\Http\Controllers\UserController@inactivar')->name('user.inactivar');
    Route::put('admin/users/{id}/activar', 'App\Http\Controllers\UserController@activar')->name('user.activar');
   
    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');


    Route::get('admin/users/new', 'App\Http\Controllers\UserController@create')->name('users.create');



    Route::post('admin/users/new', 'App\Http\Controllers\UserController@new')->name('users.new');

      //ROLES ROUTE
      Route::get('admin/roles', 'App\Http\Controllers\RoleController@index')->name('roles.index');
      Route::post('admin/roles', 'App\Http\Controllers\RoleController@store')->name('roles.store');
      Route::delete('admin/roles/{role}/destroy', 'App\Http\Controllers\RoleController@destroy')->name('role.destroy');
      Route::get('admin/roles/{role}/edit', 'App\Http\Controllers\RoleController@edit')->name('role.edit');
      Route::put('admin/roles/{role}/update', 'App\Http\Controllers\RoleController@update')->name('roles.update');


      Route::put('admin/roles/{role}/attach','App\Http\Controllers\PermissionController@attach')->name('permission.role.attach');

      Route::put('admin/roles/{role}/detach','App\Http\Controllers\PermissionController@detach')->name('permission.role.detach');



      //PERMISSIONS ROUTE
    
       Route::get('admin/permissions', 'App\Http\Controllers\PermissionController@index')->name('permissions.index');
       Route::post('admin/permissions', 'App\Http\Controllers\PermissionController@store')->name('permissions.store');
       Route::delete('admin/permissions/{permission}/destroy', 'App\Http\Controllers\PermissionController@destroy')->name('permissions.destroy');
       Route::get('admin/permissions/{permission}/edit', 'App\Http\Controllers\PermissionController@edit')->name('permissions.edit');
       Route::put('admin/permissions/{permission}/update', 'App\Http\Controllers\PermissionController@update')->name('permissions.update');

    

});

Route::get('external/cv','App\Http\Controllers\ExternoController@index')->name('hhrr.vacantes.externos');
Route::post('external/cv', 'App\Http\Controllers\ExternoController@storeExternos')->name('externos.store');
Route::get('hhrr/colaboradores','App\Http\Controllers\HhrrColaboradoresController@index')->name('colaboradores.index');



/*Route::middleware(['can:view,user'])->group(function(){
    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');
});

/*Route::middleware('role:humanresource')->group(function(){
    Route::get('hhrr/config','App\Http\Controllers\HhrrConfigController@index')->name('dep.index');
});
*/
//Route::get('hhrr/config/marcaciones','App\Http\Controllers\ConfigMarcController@indexMarcaciones')->name('marcaciones.index');
Route::get('hhrr/config/solicitudes','App\Http\Controllers\HhrrConfigController@indexSolicitudes')->name('solicitudes.index');

Route::get('hhrr/marcaciones/propias','App\Http\Controllers\HhrrMarcacionesController@indexPropias')->name('marcaciones.propias.index');
Route::post('hhrr/marcaciones/propias','App\Http\Controllers\HhrrMarcacionesController@storeMarcacionesPropias')->name('marcaciones.propias.store');


//CONFIG MARCACIONES


Route::post('hhrr/config/marcaciones', 'App\Http\Controllers\ConfigMarcController@storeTipoMarcaciones')->name('tipo.marcaciones.store');
Route::get('hhrr/config/marcaciones', 'App\Http\Controllers\ConfigMarcController@indexMarcaciones')->name('marcaciones.index');
Route::get('hhrr/config/marcaciones/{marcaciones}/edit', 'App\Http\Controllers\ConfigMarcController@edit')->name('confmarcaciones.edit');
Route::put('hhrr/config/marcaciones/{marcaciones}/update', 'App\Http\Controllers\ConfigMarcController@update')->name('confmarcaciones.update');
Route::delete('hhrr/config/marcaciones/{marcaciones}/destroy', 'App\Http\Controllers\ConfigMarcController@destroy')->name('tipomarcaciones.destroy');


//CONFIG SOLICITUDES

Route::post('hhrr/config/solicitudes', 'App\Http\Controllers\ConfigSolicitudesController@storeTipoSolicitudes')->name('tipo.solicitudes.store');
//Route::get('hhrr/config/marcaciones', 'App\Http\Controllers\ConfigMarcController@index')->name('marcaciones.index');
Route::get('hhrr/config/solicitudes/{solicitudes}/edit', 'App\Http\Controllers\ConfigSolicitudesController@edit')->name('confsolicitudes.edit');
Route::put('hhrr/config/solicitudes/{solicitudes}/update', 'App\Http\Controllers\ConfigSolicitudesController@update')->name('confsolicitudes.update');
Route::delete('hhrr/config/solicitudes/{solicitudes}/destroy', 'App\Http\Controllers\ConfigSolicitudesController@destroy')->name('tiposolicitudes.destroy');



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');




//Route::get('admin/{user}/profile','App\Http\Controllers\UserController@show')->name('admin.users.profile');


//Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('admin.users.index');



Route::get('/{id}/department',function($id){

    //me trae los departamentos
    return Department::find($id)->name;
}


);

Route::get('job/{id}/department',function($id){

    //me trae el id del departamento del cargo 
    return Job::find($id)->department_id;
}


);

Route::get('/{id}/jobs', function($id){

    //me trae los puestos de trabajo

    return Job::find($id)->name;

   /* $job = Job::find($id);
    foreach($job->department_id as $department_job){
        echo $department_job->department_id->name . "br";
    }*/

});



// HHRR COLABORADORES
Route::get('hhrr/colaboradores/index','App\Http\Controllers\HhrrColaboradoresController@index')->name('hhrr.colaboradores.index');
Route::get('hhrr/colaboradores/nuevo', 'App\Http\Controllers\HhrrColaboradoresController@create')->name('hhrr.colaboradores.create'); 
Route::post('hhrr/colaboradores/nuevo', 'App\Http\Controllers\HhrrColaboradoresController@store')->name('employees.store');
Route::put('hhrr/colaboradores/{employee}/update', 'App\Http\Controllers\HhrrColaboradoresController@update')->name('employees.update');
Route::get('hhrr/colaboradores/{employee}/edit', 'App\Http\Controllers\HhrrColaboradoresController@edit')->name('employee.edit');
Route::put('hhrr/colaboradores/index/{id}/inactivar', 'App\Http\Controllers\HhrrColaboradoresController@inactivarColaborador')->name('colaborador.inactivar');
Route::put('hhrr/colaboradores/index/{id}/activar', 'App\Http\Controllers\HhrrColaboradoresController@activarColaborador')->name('colaborador.activar');


Route::get('hhrr/colaboradores/{payslip}/payslip/edit', 'App\Http\Controllers\HhrrColaboradoresController@editPayslip')->name('payslip.edit');
Route::put('hhrr/colaboradores/{payslip}/payslip/update', 'App\Http\Controllers\HhrrColaboradoresController@updatePayslip')->name('payslip.update');
Route::delete('hhrr/colaboradores/{payslip}/payslip/destroy', 'App\Http\Controllers\HhrrColaboradoresController@destroyPayslip')->name('payslip.destroy');


// HHRR DEPARTAMENTOS
Route::get('hhrr/departamentos/index','App\Http\Controllers\DepartmentController@index')->name('hhrr.departamentos.index');
Route::post('hhrr/departamentos/index', 'App\Http\Controllers\DepartmentController@store')->name('department.store');
Route::delete('hhrr/departamentos/{department}/destroy', 'App\Http\Controllers\DepartmentController@destroy')->name('department.destroy');
Route::put('hhrr/departamentos/{department}/update', 'App\Http\Controllers\DepartmentController@update')->name('departments.update');
Route::get('hhrr/departamentos/{department}/edit', 'App\Http\Controllers\DepartmentController@edit')->name('departments.edit');



//HHRR PUESTOS TRABAJO
Route::get('hhrr/puestostrabajo/index','App\Http\Controllers\JobController@index')->name('hhrr.puestostrabajo.index');
Route::post('hhrr/puestostrabajo/index','App\Http\Controllers\JobController@store')->name('puestostrabajo.store');
Route::delete('hhrr/puestostrabajo/{job}/destroy','App\Http\Controllers\JobController@destroy')->name('puestostrabajo.destroy');
Route::put('hhrr/puestostrabajo/{job}/update','App\Http\Controllers\JobController@update')->name('puestostrabajo.update');
Route::get('hhrr/puestostrabajo/{job}/edit','App\Http\Controllers\JobController@edit')->name('puestostrabajo.edit');

Route::put('hhrr/puestostrabajo/{job}/attach','App\Http\Controllers\JobController@attach')->name('jobs.department.attach');

Route::put('hhrr/puestostrabajo/{job}/detach','App\Http\Controllers\JobController@detach')->name('jobs.department.detach');


//HHRR ROL DE PAGOS
Route::get('hhrr/rolpagos/index','App\Http\Controllers\RolPagosController@indexRolPagos')->name('hhrr.rolpagos.index');
Route::get('hhrr/rolpagos/pdf','App\Http\Controllers\PDFController@pdf')->name('descargarPDF');
Route::get('hhrr/nomina/index','App\Http\Controllers\RolPagosController@indexNomina')->name('hhrr.nomina.index');
Route::post('hhrr/nomina/index','App\Http\Controllers\RolPagosController@storeMonthYear')->name('mesanio.store');
Route::delete('hhrr/nomina/index/{payroll}/destroy', 'App\Http\Controllers\RolPagosController@destroyMonthYear')->name('monthyear.destroy');
Route::get('hhrr/nomina/{payroll}/reporte', 'App\Http\Controllers\RolPagosController@reporteNomina')->name('payroll.result');
Route::get('hhrr/nomina/{payroll}/reporte/pdf','App\Http\Controllers\PDFController@pdfNomina')->name('descargarPDFNomina');

Route::get('hhrr/rolpagos/payslip/pdf','App\Http\Controllers\PDFController@pdfPersonalPayslip')->name('descargarPayslipPersonal');
Route::get('hhrr/rolpagos/colaborador','App\Http\Controllers\RolPagosController@indexPorColaborador')->name('hhrr.rolpagos.colaborador');
Route::get('hhrr/rolpagos/payrollgenerated','App\Http\Controllers\RolPagosController@payrollEmployee')->name('employeespay.search');
Route::post('hhrr/rolpagos/payrollgenerated/insert','App\Http\Controllers\RolPagosController@insertPayslip')->name('insert.payslip');




//HHRR MARCACIONES COLABORADORES
Route::get('hhrr/marcaciones/colaboradores/index','App\Http\Controllers\HhrrMarcacionesController@indexColaboradores')->name('hhrr.marcaciones.colaboradores');
Route::post('hhrr/marcaciones/colaboradores/index/result','App\Http\Controllers\HhrrMarcacionesController@search')->name('hhrr.search.marcaciones');




//HHRR VACANTES INTERNOS
Route::get('hhrr/vacantes/internos','App\Http\Controllers\HhrrColaboradoresController@vacantesInternosIndex')->name('vacantes.internos.index');
Route::get('hhrr/vacantes/internos/enviados','App\Http\Controllers\HhrrColaboradoresController@vacantesInternosEnviados')->name('vacantes.internos.enviados');
Route::get('hhrr/vacantes/internos/{vacante}/enviados/editar','App\Http\Controllers\HhrrColaboradoresController@editVacante')->name('vacantes.internos.edit');
Route::put('hhrr/vacantes/internos/{vacante}/enviados/actualizar','App\Http\Controllers\HhrrColaboradoresController@vacantesInternosEnviadosActualizar')->name('vacantes.internos.actualizar');
Route::get('hhrr/vacantes/internos/aviso','App\Http\Controllers\HhrrColaboradoresController@vacantesInternosAviso')->name('hhrr.vacantes.enviaraviso');
Route::post('hhrr/vacantes/internos/aviso','App\Http\Controllers\VacantesController@storeVacanteInterno')->name('vacanteinterno.store');
Route::put('hhrr/vacantes/{id}/aviso/inactivar', 'App\Http\Controllers\HhrrColaboradoresController@inactivar')->name('vacanteinterno.inactivar');
Route::put('hhrr/vacantes/{id}/aviso/activar', 'App\Http\Controllers\HhrrColaboradoresController@activar')->name('vacanteinterno.activar');

//Route::get('hhrr/vacantes/aplicantes','App\Http\Controllers\VacantesController@vacantesInternosIndex')->name('vacantes.internos.index');

Route::get('vacanteinterno/{vacante}/ver','App\Http\Controllers\EmployeeController@indexVacanteInternoVer')->name('vacante.interno.aplicar');
Route::put('vacanteinterno/{vacante}/attach','App\Http\Controllers\EmployeeController@attach')->name('users.vacante.attach');

Route::put('vacanteinterno/{vacante}/detach','App\Http\Controllers\EmployeeController@detach')->name('users.vacante.detach');




//HHRR VACANTES EXTERNOS
Route::get('hhrr/vacantes/externos','App\Http\Controllers\HhrrColaboradoresController@vacantesExternosIndex')->name('vacantes.solicitudesexternos.index');
Route::get('hhrr/vacantes/externos/{externo}/edit','App\Http\Controllers\ExternoController@edit')->name('externos.edit');
Route::delete('hhrr/vacantes/externos/{externo}/destroy', 'App\Http\Controllers\ExternoController@destroy')->name('externos.destroy');
Route::put('hhrr/vacantes/externos/{externo}/edit/update', 'App\Http\Controllers\ExternoController@actualizarStatus')->name('externos.update');

Route::post('hhrr/vacantes/externos/{externo}/add', 'App\Http\Controllers\ExternoController@storeExternosToEmployees')->name('externos.store.employee');




//HHRR CONFIG ROL DE PAGOS
Route::get('hhrr/config/roldepagos/index','App\Http\Controllers\RolPagosController@index')->name('rolpagos.index');
Route::post('hhrr/config/roldepagos/index','App\Http\Controllers\RolPagosController@store')->name('rolpagos.store');
Route::delete('hhrr/config/{payrolls}/destroy', 'App\Http\Controllers\RolPagosController@destroy')->name('rolpagos.destroy');
Route::get('hhrr/config/{payrolls}/edit','App\Http\Controllers\RolPagosController@edit')->name('rolpagos.edit');
Route::put('hhrr/config/{payrolls}/update', 'App\Http\Controllers\RolPagosController@update')->name('rolpagos.update');


Route::post('hhrr/config/roldepagos/index','App\Http\Controllers\RolPagosController@storeImpuesto')->name('impuestos.store');


//FORMULARIO SOLICITUDES
Route::get('missolicitudes/new', 'App\Http\Controllers\SolicitudesController@solicitudesForm')->name('hhrr.solicitudes.create');
Route::post('missolicitudes/new', 'App\Http\Controllers\SolicitudesController@storeSolicitudes')->name('solicitudes.store');


//HHRR SOLICITUDES PROPIAS
Route::get('hhrr/solicitudes/propias/index','App\Http\Controllers\SolicitudesController@indexPropias')->name('hhrr.solicitudes.propias.index');




//HHRR SOLICITUDES COLABORADORES
Route::get('hhrr/solicitudes/colaboradores/index','App\Http\Controllers\SolicitudesController@indexColaboradores')->name('hhrr.solicitudes.colaboradores.index');
Route::put('hhrr/solicitudes/colaboradores/index/{id}/aprobar','App\Http\Controllers\SolicitudesController@approve')->name('hhrr.solicitud.colaborador.aprobar');
Route::put('hhrr/solicitudes/colaboradores/index/{id}/rechazar','App\Http\Controllers\SolicitudesController@decline')->name('hhrr.solicitud.colaborador.rechazar');
Route::get('hhrr/solicitudes/colaboradores/{solicitud}/ver', 'App\Http\Controllers\SolicitudesController@rrhhViewSol')->name('hhrr.solicitud.view');





//COLABORADORES EMPIEZA AQUI!

//MARCACIONES COLABORADORES
Route::get('colaborador/marcaciones/index','App\Http\Controllers\EmployeeController@indexMarcacionesEmployees')->name('colaborador.marcaciones.index');
Route::post('colaborador/marcaciones/index','App\Http\Controllers\EmployeeController@storeMarcaciones')->name('colaborador.marcaciones.store');



//SOLICITUDES COLABORADORES
Route::get('colaborador/solicitudes/index','App\Http\Controllers\EmployeeController@indexSolicitudesColaboradores')->name('colaborador.solicitudes.index');
Route::get('colaborador/solicitudes/{solicitud}/edit', 'App\Http\Controllers\EmployeeController@editSolicitud')->name('colaborador.solicitud.edit');
Route::delete('colaborador/solicitudes/{solicitud}/destroy', 'App\Http\Controllers\EmployeeController@destroy')->name('solicitud.destroy');

//VACANTE INTERNO COLABORADORES
Route::get('colaborador/vacanteinterno/index','App\Http\Controllers\EmployeeController@indexVacanteInterno')->name('colaborador.vacante.index');


//AUTOGESTION ROLES

Route::get('colaborador/autogestion/roles/index','App\Http\Controllers\EmployeeController@indexRolesColaboradores')->name('autogestion.colaboradores.roles.index');
Route::get('colaborador/autogestion/roles/{payslip}/show', 'App\Http\Controllers\EmployeeController@showEmployeePayslip')->name('employee.payslip.show');
Route::get('colaborador/autogestion/roles/{payslip}/pdf','App\Http\Controllers\PDFController@payslipPDF')->name('descargarPayslipPDF');


//AUTOGESTION CERTIFICADOS

Route::get('colaborador/autogestion/certificados/index','App\Http\Controllers\EmployeeController@indexCertificadosColaboradores')->name('autogestion.colaboradores.certificados.index');
Route::post('colaborador/autogestion/certificados/index/pdf','App\Http\Controllers\PDFController@certificadoLaboral')->name('descargarLaboral');

//AUTOGESTION FORMULARIO GASTOS
Route::get('colaborador/autogestion/formulario/impuesto/renta/index','App\Http\Controllers\EmployeeController@indexTaxForm')->name('autogestion.colaboradores.formulario.impuesto.index');
Route::get('colaborador/autogestion/formulario/impuesto/renta','App\Http\Controllers\EmployeeController@indexFormularioImpuestoRenta')->name('autogestion.colaboradores.formulario.impuesto');
Route::get('colaborador/autogestion/formulario/impuesto/renta/calculate','App\Http\Controllers\EmployeeController@calculateTax')->name('calculateTax');
//Route::post('colaborador/autogestion/formulario/impuesto/renta/calculate','App\Http\Controllers\EmployeeController@calculateTax')->name('calculateTax');
Route::post('colaborador/autogestion/formulario/impuesto/renta/calculate','App\Http\Controllers\EmployeeController@storeTax')->name('store.tax');
Route::get('colaborador/autogestion/formulario/impuesto/renta/{taxes}/view', 'App\Http\Controllers\EmployeeController@editTaxes')->name('edit.tax');
Route::delete('colaborador/autogestion/formulario/impuesto/renta/{taxes}/destroy', 'App\Http\Controllers\EmployeeController@destroyTaxes')->name('destroy.taxes');

//COLABORADORES FIN!



//SUPERVISOR EMPIEZA AQUI 

//MARCACIONES SUPERVISOR y ver colaboradores 
Route::get('supervisor/marcaciones/index','App\Http\Controllers\SupervisorController@indexMarcacionesSupervisor')->name('supervisor.marcaciones.index');
Route::post('supervisor/marcaciones/index','App\Http\Controllers\SupervisorController@storeMarcacionesPropias')->name('supervisor.marcaciones.store');
Route::get('supervisor/marcacionescolaboradores/index','App\Http\Controllers\SupervisorController@indexMarcacionesColaboradores')->name('supervisor.colaboradores.marcaciones.index');
Route::post('supervisor/marcacionescolaboradores/index/result','App\Http\Controllers\SupervisorController@searchMarcaciones')->name('search.marcacion'); 


//SOLICITUDES SUPERVISOR
Route::get('supervisor/solicitudes/index','App\Http\Controllers\SupervisorController@indexSolicitudesSupervisor')->name('supervisor.solicitudes.index');
Route::get('supervisor/solicitudescolaboradores/index','App\Http\Controllers\SupervisorController@indexSolicitudesColaboradores')->name('supervisor.solicitudescolaboradores.index');
Route::get('supervisor/solicitudescolaboradores/{solicitud}/ver', 'App\Http\Controllers\SupervisorController@viewSolicitud')->name('supervisor.solicitud.view');


Route::put('supervisor/solicitudescolaboradores/index/{id}/aprobar','App\Http\Controllers\SupervisorController@approve')->name('solicitud.colaborador.aprobar');
Route::put('supervisor/solicitudescolaboradores/index/{id}/rechazar','App\Http\Controllers\SupervisorController@decline')->name('solicitud.colaborador.rechazar');



//VACANTE INTERNO SUPERVISOR
Route::get('supervisor/vacanteinterno/index','App\Http\Controllers\SupervisorController@indexVacanteInterno')->name('supervisor.vacante.index');



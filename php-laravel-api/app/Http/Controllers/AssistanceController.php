<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssistanceAddRequest;
use App\Http\Requests\AssistanceEditRequest;
use App\Http\Requests\AssistanceconfirmarRequest;
use App\Models\Assistance;
use Illuminate\Http\Request;
use Exception;
class AssistanceController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Assistance::query();
		if($request->search){
			$search = trim($request->search);
			Assistance::search($query, $search);
		}
		$query->join("classes_r", "assistance.classes_r", "=", "classes_r.id");
		$query->join("user", "assistance.user", "=", "user.id");
		$query->join("assistance_confirmation", "assistance.confirmation", "=", "assistance_confirmation.id");
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$orderby = $request->orderby ?? "assistance.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Assistance::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Assistance::query();
		$query->join("classes_r", "assistance.classes_r", "=", "classes_r.id");
		$query->join("user", "assistance.user", "=", "user.id");
		$query->join("assistance_confirmation", "assistance.confirmation", "=", "assistance_confirmation.id");
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$record = $query->findOrFail($rec_id, Assistance::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(AssistanceAddRequest $request){
		$modeldata = $request->validated();
		
		//save Assistance record
		$record = Assistance::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AssistanceEditRequest $request, $rec_id = null){
		$query = Assistance::query();
		$record = $query->findOrFail($rec_id, Assistance::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Assistance::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_assis_2(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Assistance::query();
		if($request->search){
			$search = trim($request->search);
			Assistance::search($query, $search);
		}
		$query->join("classes_r", "assistance.classes_r", "=", "classes_r.id");
		$query->join("user", "assistance.user", "=", "user.id");
		$query->join("assistance_confirmation", "assistance.confirmation", "=", "assistance_confirmation.id");
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$orderby = $request->orderby ?? "assistance.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Assistance::listAssis2Fields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function asiss_reserv($rec_id = null){
		$query = Assistance::query();
		$record = $query->findOrFail($rec_id, Assistance::asissReservFields());
		return $this->respond($record);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function asiss_lista($rec_id = null){
		$query = Assistance::query();
		$record = $query->findOrFail($rec_id, Assistance::asissListaFields());
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function confirmar(AssistanceconfirmarRequest $request, $rec_id = null){
		$query = Assistance::query();
		$record = $query->findOrFail($rec_id, Assistance::confirmarFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function alumnos_reser($rec_id = null){
		$query = Assistance::query();
		$record = $query->findOrFail($rec_id, Assistance::alumnosReserFields());
		return $this->respond($record);
	}
}

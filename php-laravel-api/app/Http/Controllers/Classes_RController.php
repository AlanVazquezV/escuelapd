<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classes_RAddRequest;
use App\Http\Requests\Classes_REditRequest;
use App\Models\Classes_R;
use Illuminate\Http\Request;
use Exception;
class Classes_RController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Classes_R::query();
		if($request->search){
			$search = trim($request->search);
			Classes_R::search($query, $search);
		}
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$query->join("classes_status", "classes_r.status", "=", "classes_status.id");
		$orderby = $request->orderby ?? "classes_r.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Classes_R::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Classes_R::query();
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$query->join("classes_status", "classes_r.status", "=", "classes_status.id");
		$record = $query->findOrFail($rec_id, Classes_R::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Classes_RAddRequest $request){
		$modeldata = $request->validated();
		
		//save Classes_R record
		$record = Classes_R::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Classes_REditRequest $request, $rec_id = null){
		$query = Classes_R::query();
		$record = $query->findOrFail($rec_id, Classes_R::editFields());
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
		$query = Classes_R::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function clases_list($rec_id = null){
		$query = Classes_R::query();
		$record = $query->findOrFail($rec_id, Classes_R::clasesListFields());
		return $this->respond($record);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function clases_reservas($rec_id = null){
		$query = Classes_R::query();
		$record = $query->findOrFail($rec_id, Classes_R::clasesReservasFields());
		return $this->respond($record);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function clases_r_lista_admin(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Classes_R::query();
		if($request->search){
			$search = trim($request->search);
			Classes_R::search($query, $search);
		}
		$query->join("classes", "classes_r.classes", "=", "classes.id");
		$query->join("classes_status", "classes_r.status", "=", "classes_status.id");
		$orderby = $request->orderby ?? "classes_r.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Classes_R::clasesRListaAdminFields());
		return $this->respond($records);
	}
}

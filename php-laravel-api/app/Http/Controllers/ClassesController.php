<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassesAddRequest;
use App\Http\Requests\ClassesEditRequest;
use App\Models\Classes;
use Illuminate\Http\Request;
use Exception;
class ClassesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Classes::query();
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search);
		}
		$query->join("cycle", "classes.cycle", "=", "cycle.id");
		$query->join("classes_modality", "classes.modality", "=", "classes_modality.id");
		$query->join("user", "classes.user", "=", "user.id");
		$query->join("schedule", "classes.id", "=", "schedule.classes");
		$query->join("schedule_name", "schedule.name", "=", "schedule_name.id");
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Classes::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Classes::query();
		$query->join("cycle", "classes.cycle", "=", "cycle.id");
		$query->join("classes_modality", "classes.modality", "=", "classes_modality.id");
		$query->join("user", "classes.user", "=", "user.id");
		$query->join("schedule", "classes.id", "=", "schedule.classes");
		$query->join("schedule_name", "schedule.name", "=", "schedule_name.id");
		$record = $query->findOrFail($rec_id, Classes::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(ClassesAddRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("banner", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['banner'], "banner");
			$modeldata['banner'] = $fileInfo['filepath'];
		}
		
		//save Classes record
		$record = Classes::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ClassesEditRequest $request, $rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
		
		if( array_key_exists("banner", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['banner'], "banner");
			$modeldata['banner'] = $fileInfo['filepath'];
		}
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
		$query = Classes::query();
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
	function list_usuario(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Classes::query();
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search);
		}
		$query->join("classes_modality", "classes.modality", "=", "classes_modality.id");
		$query->join("cycle", "classes.cycle", "=", "cycle.id");
		$query->join("schedule", "classes.id", "=", "schedule.classes");
		$query->join("schedule_name", "schedule.name", "=", "schedule_name.id");
		$query->join("user", "classes.user", "=", "user.id");
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Classes::listUsuarioFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function alumnos_listi($rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::alumnosListiFields());
		return $this->respond($record);
	}
}

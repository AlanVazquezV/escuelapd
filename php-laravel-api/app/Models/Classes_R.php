<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Classes_R extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'classes_r';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["classes","date","status"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				classes.name LIKE ?  OR 
				classes_status.label LIKE ?  OR 
				classes_r.status LIKE ?  OR 
				classes.description LIKE ?  OR 
				classes.banner LIKE ?  OR 
				classes.place LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes_status.label AS classes_status_label", 
			"classes_r.id AS id", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes_status.label AS classes_status_label", 
			"classes_r.id AS id", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes_status.label AS classes_status_label", 
			"classes_r.id AS id", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes_status.label AS classes_status_label", 
			"classes_r.id AS id", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"classes", 
			"date", 
			"status", 
			"id" 
		];
	}
	

	/**
     * return clasesList page fields of the model.
     * 
     * @return array
     */
	public static function clasesListFields(){
		return [ 
			"id", 
			"classes", 
			"date", 
			"status" 
		];
	}
	

	/**
     * return exportClasesList page fields of the model.
     * 
     * @return array
     */
	public static function exportClasesListFields(){
		return [ 
			"id", 
			"classes", 
			"date", 
			"status" 
		];
	}
	

	/**
     * return clasesReservas page fields of the model.
     * 
     * @return array
     */
	public static function clasesReservasFields(){
		return [ 
			"id", 
			"classes", 
			"date", 
			"status" 
		];
	}
	

	/**
     * return exportClasesReservas page fields of the model.
     * 
     * @return array
     */
	public static function exportClasesReservasFields(){
		return [ 
			"id", 
			"classes", 
			"date", 
			"status" 
		];
	}
	

	/**
     * return clasesRListaAdmin page fields of the model.
     * 
     * @return array
     */
	public static function clasesRListaAdminFields(){
		return [ 
			"classes_r.id AS id", 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes_status.label AS classes_status_label", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * return exportClasesRListaAdmin page fields of the model.
     * 
     * @return array
     */
	public static function exportClasesRListaAdminFields(){
		return [ 
			"classes_r.id AS id", 
			"classes_r.date AS date", 
			"classes.name AS classes_name", 
			"classes_status.label AS classes_status_label", 
			"classes.id AS classes_id", 
			"classes_status.id AS classes_status_id" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}

<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Classes extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'classes';
	

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
	protected $fillable = ["name","description","cycle","modality","time","user","place","banner"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				classes.name LIKE ?  OR 
				classes.description LIKE ?  OR 
				classes.banner LIKE ?  OR 
				classes.place LIKE ?  OR 
				cycle.label LIKE ?  OR 
				classes_modality.label LIKE ?  OR 
				user.username LIKE ?  OR 
				user.name LIKE ?  OR 
				user.lastname LIKE ?  OR 
				user.email LIKE ?  OR 
				user.mobile LIKE ?  OR 
				schedule_name.label LIKE ?  OR 
				user.password LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.banner AS banner", 
			"classes.time AS time", 
			"classes.place AS place", 
			"cycle.label AS cycle_label", 
			"classes_modality.label AS classes_modality_label", 
			"user.username AS user_username", 
			"user.image AS user_image", 
			"cycle.id AS cycle_id", 
			"classes_modality.id AS classes_modality_id", 
			"user.id AS user_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id", 
			"classes.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.banner AS banner", 
			"classes.time AS time", 
			"classes.place AS place", 
			"cycle.label AS cycle_label", 
			"classes_modality.label AS classes_modality_label", 
			"user.username AS user_username", 
			"user.image AS user_image", 
			"cycle.id AS cycle_id", 
			"classes_modality.id AS classes_modality_id", 
			"user.id AS user_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id", 
			"classes.id AS id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"classes.banner AS banner", 
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.time AS time", 
			"classes.place AS place", 
			"cycle.label AS cycle_label", 
			"classes_modality.label AS classes_modality_label", 
			"user.username AS user_username", 
			"user.email AS user_email", 
			"schedule_name.label AS schedule_name_label", 
			"classes.id AS id", 
			"cycle.id AS cycle_id", 
			"classes_modality.id AS classes_modality_id", 
			"user.id AS user_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"classes.banner AS banner", 
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.time AS time", 
			"classes.place AS place", 
			"cycle.label AS cycle_label", 
			"classes_modality.label AS classes_modality_label", 
			"user.username AS user_username", 
			"user.email AS user_email", 
			"schedule_name.label AS schedule_name_label", 
			"classes.id AS id", 
			"cycle.id AS cycle_id", 
			"classes_modality.id AS classes_modality_id", 
			"user.id AS user_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"name", 
			"description", 
			"cycle", 
			"modality", 
			"time", 
			"user", 
			"place", 
			"banner", 
			"id" 
		];
	}
	

	/**
     * return listUsuario page fields of the model.
     * 
     * @return array
     */
	public static function listUsuarioFields(){
		return [ 
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.banner AS banner", 
			"classes.time AS time", 
			"classes.place AS place", 
			"classes_modality.label AS classes_modality_label", 
			"cycle.label AS cycle_label", 
			"schedule_name.label AS schedule_name_label", 
			"user.username AS user_username", 
			"classes.id AS id", 
			"classes_modality.id AS classes_modality_id", 
			"cycle.id AS cycle_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id", 
			"user.id AS user_id" 
		];
	}
	

	/**
     * return exportListUsuario page fields of the model.
     * 
     * @return array
     */
	public static function exportListUsuarioFields(){
		return [ 
			"classes.name AS name", 
			"classes.description AS description", 
			"classes.banner AS banner", 
			"classes.time AS time", 
			"classes.place AS place", 
			"classes_modality.label AS classes_modality_label", 
			"cycle.label AS cycle_label", 
			"schedule_name.label AS schedule_name_label", 
			"user.username AS user_username", 
			"classes.id AS id", 
			"classes_modality.id AS classes_modality_id", 
			"cycle.id AS cycle_id", 
			"schedule.id AS schedule_id", 
			"schedule_name.id AS schedule_name_id", 
			"user.id AS user_id" 
		];
	}
	

	/**
     * return alumnosListi page fields of the model.
     * 
     * @return array
     */
	public static function alumnosListiFields(){
		return [ 
			"id", 
			"name", 
			"description", 
			"banner", 
			"cycle", 
			"modality", 
			"time", 
			"user", 
			"place" 
		];
	}
	

	/**
     * return exportAlumnosListi page fields of the model.
     * 
     * @return array
     */
	public static function exportAlumnosListiFields(){
		return [ 
			"id", 
			"name", 
			"description", 
			"banner", 
			"cycle", 
			"modality", 
			"time", 
			"user", 
			"place" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}

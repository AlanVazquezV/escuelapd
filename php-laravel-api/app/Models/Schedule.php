<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Schedule extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'schedule';
	

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
	protected $fillable = ["name","classes"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				classes.name LIKE ?  OR 
				schedule_name.label LIKE ?  OR 
				schedule.name LIKE ?  OR 
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
			"schedule.id AS id", 
			"classes.name AS classes_name", 
			"schedule_name.label AS schedule_name_label", 
			"classes.id AS classes_id", 
			"schedule_name.id AS schedule_name_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"schedule.id AS id", 
			"classes.name AS classes_name", 
			"schedule_name.label AS schedule_name_label", 
			"classes.id AS classes_id", 
			"schedule_name.id AS schedule_name_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes.time AS classes_time", 
			"schedule_name.label AS schedule_name_label", 
			"schedule.id AS id", 
			"classes.id AS classes_id", 
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
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes.time AS classes_time", 
			"schedule_name.label AS schedule_name_label", 
			"schedule.id AS id", 
			"classes.id AS classes_id", 
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
			"classes", 
			"id" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}

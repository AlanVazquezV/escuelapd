<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Assistance extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'assistance';
	

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
	protected $fillable = ["classes_r","user","confirmation"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				classes.name LIKE ?  OR 
				user.name LIKE ?  OR 
				user.lastname LIKE ?  OR 
				user.username LIKE ?  OR 
				assistance_confirmation.label LIKE ?  OR 
				classes_r.status LIKE ?  OR 
				user.email LIKE ?  OR 
				user.mobile LIKE ?  OR 
				classes.description LIKE ?  OR 
				classes.banner LIKE ?  OR 
				classes.place LIKE ?  OR 
				user.password LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"classes.name AS classes_name", 
			"classes_r.date AS classes_r_date", 
			"user.name AS user_name", 
			"user.lastname AS user_lastname", 
			"user.username AS user_username", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id", 
			"assistance.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"classes.name AS classes_name", 
			"classes_r.date AS classes_r_date", 
			"user.name AS user_name", 
			"user.lastname AS user_lastname", 
			"user.username AS user_username", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id", 
			"assistance.id AS id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"classes_r.classes AS classes_r_classes", 
			"classes_r.date AS classes_r_date", 
			"user.username AS user_username", 
			"user.email AS user_email", 
			"user.mobile AS user_mobile", 
			"user.image AS user_image", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes.time AS classes_time", 
			"classes.place AS classes_place", 
			"assistance.id AS id", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"classes_r.classes AS classes_r_classes", 
			"classes_r.date AS classes_r_date", 
			"user.username AS user_username", 
			"user.email AS user_email", 
			"user.mobile AS user_mobile", 
			"user.image AS user_image", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"classes.name AS classes_name", 
			"classes.description AS classes_description", 
			"classes.banner AS classes_banner", 
			"classes.time AS classes_time", 
			"classes.place AS classes_place", 
			"assistance.id AS id", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"classes_r", 
			"user", 
			"confirmation", 
			"id" 
		];
	}
	

	/**
     * return listAssis2 page fields of the model.
     * 
     * @return array
     */
	public static function listAssis2Fields(){
		return [ 
			"classes.name AS classes_name", 
			"classes_r.date AS classes_r_date", 
			"user.name AS user_name", 
			"user.lastname AS user_lastname", 
			"user.username AS user_username", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"assistance.id AS id", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return exportListAssis2 page fields of the model.
     * 
     * @return array
     */
	public static function exportListAssis2Fields(){
		return [ 
			"classes.name AS classes_name", 
			"classes_r.date AS classes_r_date", 
			"user.name AS user_name", 
			"user.lastname AS user_lastname", 
			"user.username AS user_username", 
			"assistance_confirmation.label AS assistance_confirmation_label", 
			"assistance.id AS id", 
			"classes_r.id AS classes_r_id", 
			"user.id AS user_id", 
			"assistance_confirmation.id AS assistance_confirmation_id", 
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return asissReserv page fields of the model.
     * 
     * @return array
     */
	public static function asissReservFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * return exportAsissReserv page fields of the model.
     * 
     * @return array
     */
	public static function exportAsissReservFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * return asissLista page fields of the model.
     * 
     * @return array
     */
	public static function asissListaFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * return exportAsissLista page fields of the model.
     * 
     * @return array
     */
	public static function exportAsissListaFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * return confirmar page fields of the model.
     * 
     * @return array
     */
	public static function confirmarFields(){
		return [ 
			"confirmation", 
			"id" 
		];
	}
	

	/**
     * return alumnosReser page fields of the model.
     * 
     * @return array
     */
	public static function alumnosReserFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * return exportAlumnosReser page fields of the model.
     * 
     * @return array
     */
	public static function exportAlumnosReserFields(){
		return [ 
			"id", 
			"classes_r", 
			"user", 
			"confirmation" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}

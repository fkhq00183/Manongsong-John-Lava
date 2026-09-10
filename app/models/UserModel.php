    <?php
    defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

    /**
     * Model: UserModel
     * 
     * Automatically generated via CLI.
     */
    class UserModel extends Model {
        protected $table = 'users';
        protected $primary_key = 'id';
        protected $fillable = [
            'username',
            'email',
            'password',
            'role',
            'is_active'
        ];
        protected $guarded = ['id'];
        protected $has_soft_delete;
        

        public function __construct()
        {
            parent::__construct();
        }
    }

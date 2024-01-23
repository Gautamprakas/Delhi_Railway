 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['jwt_key'] = 'Vdai@123#';

/*Generated token will expire in 1 minute for sample code
* Increase this value as per requirement for production
*/
$config['token_timeout'] = 365*24*60;

/* End of file jwt.php */
/* Location: ./application/config/jwt.php */
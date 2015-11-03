<?php
class usuariosController extends Appcontroller
{
	/**
	 * @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 **/
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		//allows you to visualize all the existing users in the database 
		$this->_view->usuarios = 'Listado de usuarios';
		$this->_view->usuarios = $this->db->find('usuarios', 'all');
		$this->_view->renderizar('index');

	}

	public function add(){
	/**
	 * add function to add users
	 * @return  void
	 */	
		if ($_POST){
			$pass = new Password();
			$_POST['password'] = $pass->getPassword($_POST['password']);
			if ($this->db->save("usuarios", $_POST)) {
				$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
			}else{
				$this->redirect(array('controller'=>'usuarios', 'action'=>'add'));
			}
		}else{
			$this->_view->titulo = "Agregar usuario";
			$this->_view->renderizar('add');
		}		
	}
	public function edit($id = null){
	/**
	 * edit function to edit users
	 * @param  string $id contains the id of the row
	 * @return void
	 */
		if ($_POST){
			if (!empty($_POST['pass'])) {
				$pass = new Password();
				$_POST['password'] = $pass->getPassword($_POST['pass']);;
			}
			if ($this->db->update("usuarios", $_POST)) {
				$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
			}else{
				$this->redirect(array('controller'=>'usuarios', 'action'=>'edit'));
			}
		}else{
			$this->_view->titulo = "Editar usuario";
			$this->_view->usuario = $this->db->find('usuarios', 'first', array('conditions'=>'id='.$id));
			$this->_view->renderizar('edit');
		}	
		
	}
	public function delete($id){
	/**
	 * eliminates users
	 * @param  string $id contains the id of the row
	 * @return void
	 */
		$conditions = "id=".$id;
		if ($this->db->delete('usuarios', $conditions)) {
			$this->redirect(array('controller'=>'usuarios'));
		}
		
	}
	public function login(){
	/**
	 * function that allows the user to login
	 * @param password $pass password of the user
	 * @param $filter to validate that the password is correct
	 * @param $auth to authorize the entrance to de system
	 * 
	 * @return void
	 */
		if ($_POST) {
			$pass = new Password();
			$filter = new Validations();
			$auth = new Authorization();

			$username = $filter->sanitizeText($_POST['username']);
			$password = $filter->sanitizeText($_POST['password']);

			$options = array('conditions' => "username = '$username'");
			$usuario = $this->db->find('usuarios', 'first', $options);

			if ($pass->isValid($password, $usuario['password'])) {
				$auth->login($usuario);
				$this->redirect(array('controller' =>'tareas'));
			}else{
				echo "Usuario no valido";
			}
		}
		$this->_view->renderizar('login');
	}
	public function logout(){
	/**
	 * function to logout of the session
	 * @return void
	 */
		$auth = new Authorization();
		$auth->logout();
	}


}
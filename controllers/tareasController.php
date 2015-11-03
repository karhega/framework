<?php
class tareasController extends Appcontroller
{
	/**
	* @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 **/
	public function __construct(){
		parent::__construct();
	}

	public function index() {
	/**
	 * index list of the things to do (homework)
	 * @return  void
	 */
		$conditions = array(
			"conditions"=>" tareas.categoria_id=categorias.id",
			"order"=>"tareas.id asc"
		);

		$this->_view->titulo = 'Listado de tareas';
		$tareas = $this->db->find('tareas, categorias', 'all', $conditions);
		$this->_view->tareas = $tareas->fetchAll(PDO::FETCH_NUM);
		$this->_view->renderizar('index');
	}
	public function edit($id = null){
	/**
	 * edit function to edit the homework
	 * @param  string $id contains the id of the row
	 * @return void
	 */
		if ($_POST) {
				
				if ($this->db->update('tareas', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
				}else{
					$this->redirect(
							array(
									'controller'=>'tareas',
									'action'=>'edit/'.$_POST['id']
								)
						);
					}		
		} else {
				$conditions = array(
						'conditions'=>'id='.$id
					);
				$this->_view->tarea = $this->db->find('tareas', 'first', $conditions);
				$this->_view->categorias = $this->db->find('categorias','all');
				$this->_view->titulo = "Editar tarea";
				$this->_view->renderizar('edit');
		}

	}
	public function add(){
	/**
	 * function to add a new homework
	 * @return void
	 */
		if ($_POST) {
			if ($this->db->save('tareas', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
			}
			
		}else{
			$this->_view->categorias = $this->db->find('categorias','all');
			$this->_view->titulo = "Agregar tarea";
			$this->_view->renderizar('add');
		}
	}
	public function delete($id){
	/**
	 * eliminates homework
	 * @param  string $id contains the id of the row
	 * @return void
	 */
		$conditions = "id=".$id;
		if ($this->db->delete('tareas', $conditions)) {
			$this->redirect(array('controller'=>'tareas'));
		}
	}
}
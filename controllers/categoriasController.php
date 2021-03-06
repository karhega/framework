<?php
	/**
	* @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 **/
	class categoriasController extends Appcontroller{

		public function __construct(){
		parent::__construct();
	}
	public function index() {
	/**
	 * index list of the categories
	 * @return void
	 */
		$this->_view->titulo = 'Listado de categorias';
		$this->_view->categorias = $this->db->find('categorias', 'all');
		$this->_view->renderizar('index');
	}
	public function edit($id = null){
	/**
	 * edit allows to edit the categories
	 * @param  string $id contains the id of the row
	 * @return void
	 */
		if ($_POST) {
				
				if ($this->db->update('categorias', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'edit/'.$_POST['id']
							)
					);
			}
		}else{
		$conditions = array(
				'conditions'=>'id='.$id
			);
		$this->_view->categoria = $this->db->find('categorias', 'first', $conditions);
		$this->_view->titulo = "Editar Categoría";
		$this->_view->renderizar('edit');
		}

	}
		public function add(){
		/**
		 * add allows to add more categories
		 * @return  void
		 */
		if ($_POST) {
			if ($this->db->save('categorias', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}
			
		}else{
			$this->_view->titulo = "Agregar Categoría";
			$this->_view->renderizar('add');
		}

	}
		public function delete($id){
		/**
		 * function that eliminates the categories
		 * @param  string $id contains the id of the row
		 * @return void
		 */

		$conditions = "id=".$id;
		if ($this->db->delete('categorias', $conditions)) {
			$this->redirect(array('controller'=>'categorias'));
		}

	}



}




?>
<?php

namespace App\Http\Controllers;

use App\Car;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarsController extends Controller
{
	public $message = '';
	public $callback = null;

	public function __construct(Request $request) {
		if(!empty($_GET['callback'])) {
			$this->callback = $_GET['callback'];
		}
	}

	/**
	 * Action to list brands
	 * @return ['id', 'marca']
	 */
	public function brands($id = null)
	{
		$brands = Brand::select('id', 'marca')
		->orderBy('marca', 'ASC')
		->get();
		return $this->convertCallback($brands, $this->callback);	
	}

	/**
	 * Action to list data
	 * @return ['id', 'marca', 'modelo', 'ano']
	 */
	public function index($id = null)
	{
		$cars = Car::select('carros.id', 'carros.marca AS marcaId', 'marcas.marca', 'carros.modelo', 'carros.ano')
		->join('marcas', 'marcas.id', 'carros.marca')
		->where(function($where) use ($id) {
			if(!is_null($id)) {
				$where->where('carros.id', $id);
			}
		})
		->get();
 		return $this->convertCallback($cars, $this->callback);
	}


	/**
	 * Action to insert new data
	 * @return ['error', 'message', 'id']
	 */
	public function insert(Request $request)
	{
		$data = $request->all();
		if(!$this->validade($data)) {
			$return = json_encode(['error' => true, 'message' => $this->message]);
			return $this->convertCallback($return, $this->callback);
		}

		$cars = Car::insertGetId($data);
		$return  = json_encode(['error' => false, 'message' => 'Dados inseridos com sucesso', 'id' => $cars]);
		return $this->convertCallback($return, $this->callback);
	}


	/**
	 * Action to update existing data
	 * @return ['error', 'message', 'id']
	 */
	public function update(Request $request, $id)
	{
		$data = $request->all();
		if(!$this->validade($data)) {
			$return = json_encode(['error' => true, 'message' => $this->message]);
			return $this->convertCallback($return, $this->callback);
		}

		$cars = Car::where('id', $id)
		->update($data);

		if(empty($cars)) {
			$return = json_encode(['error' => false, 'message' => 'Nenhum dado foi alterado', 'id' => $id]);
			return $this->convertCallback($return, $this->callback);
		}
		$return = json_encode(['error' => false, 'message' => 'Dados alterados com sucesso', 'id' => $id]);
		return $this->convertCallback($return, $this->callback);
	}


	/**
	 * Action to delete existing data
	 * @return ['error', 'message', 'id']
	 */
	public function delete($id = null)
	{
		$return = json_encode(['error' => false, 'message' => 'Códido não existente ou incorreto.', 'id' => $id]);
		if(is_null($id)) {
			return $this->convertCallback($return, $this->callback);
		}

		$cars = Car::where('id', $id)->delete();

		if(empty($cars)) {
			return $this->convertCallback($return, $this->callback);
		}

		$return = json_encode(['error' => false, 'message' => 'Dados excluidos com sucesso', 'id' => $id]);
		return $this->convertCallback($return, $this->callback);
	}


	/**
	 * Action to validate input data
	 * @return ['marca', 'modelo', 'ano']
	 */
	private function validade(array $data)
	{
		if(empty($data['marca']) || !is_numeric($data['marca'])) {
			$this->message = 'O campo "marca" está incorreto.';
			return false;
		}
		if(empty($data['modelo'])) {
			$this->message = 'O campo "modelo" está incorreto.';
			return false;
		}
		if(empty($data['ano']) || !is_numeric($data['ano'])) {
			$this->message = 'O campo "ano" está incorreto.';
			return false;
		}
		return true;  
	}


	/**
	 * Output it, wrapped in the method name
	 * @return ['marca', 'modelo', 'ano']
	 */
	private function convertCallback($data, $callback = null) {
 		if(!empty($callback)) {
			return $callback . '('.$data.')';
 		}
		return $data;
	}

}

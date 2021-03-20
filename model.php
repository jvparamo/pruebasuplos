
<?php
class Model
{
    private $pdo;
    public $id;
    public $city;
    public $type;
    public $city_id;
    public $type_id;
    public $phone;
    public $address;
    public $postal_code;
    public $price;
    public function __CONSTRUCT()
	{
        try
        {
            $this->db = Conect::connection();;     
		}
        catch(Exception $e)
        {
			die($e->getMessage());
		}
	}
    public function cities()
	{
        try
        {
            $stm = $this->db->prepare("SELECT * FROM intelcost_ciudades;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function goods()
	{
        try
        {
            $stm = $this->db->prepare("SELECT ib.*, it.name 'type', ic.name 'city'
                                      FROM intelcost_bienes ib
                                      INNER JOIN  intelcost_tipos it
                                      ON    it.id = ib.type_id
                                      INNER JOIN  intelcost_ciudades ic
                                      ON ic.id = ib.city_id;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function good_reports($data)
	{
        try
        {
            $stm = $this->db->prepare("SELECT ib.*, it.name 'type', ic.name 'city'
                                      FROM intelcost_bienes ib
                                      INNER JOIN  intelcost_tipos it
                                      ON    it.id = ib.type_id
                                      INNER JOIN  intelcost_ciudades ic
                                      ON ic.id = ib.city_id
                                      HAVING type =? OR city = ?;");
            $stm->execute(array(
                $data->city,
                $data->type
             ));
            return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function register_city($data)
	{
		try 
		{
		$sql = "INSERT INTO `intelcost_ciudades` (`name`) 
		        VALUES (?)";

		$this->db->prepare($sql)
		     ->execute(
				array(
                    $data->city                    
                )
			);
        return $this->db->lastInsertId();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
    public function register_type($data)
	{
		try 
		{
		$sql = "INSERT INTO `intelcost_tipos` (`name`) 
		        VALUES (?)";

		$this->db->prepare($sql)->execute(array($data->type)
			);
        return $this->db->lastInsertId();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
    public function register_goods($data)
	{
		try 
		{
		$sql = "INSERT INTO `intelcost_bienes` (`price`, `city_id`, `type_id`, `phone`, `address`, `postal_code`) 
		        VALUES (?,?,?,?,?,?)";
                $this->db->prepare($sql)->execute(
                    array(
                            $data->price,
                            $data->city_id,
                            $data->type_id,
                            $data->phone,
                            $data->address,
                            $data->postal_code,
                         )
			);
        return $this->db->lastInsertId();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
    public function delete($id)
	{
		try 
		{
			$stm = $this->db
			            ->prepare("DELETE FROM intelcost_bienes WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
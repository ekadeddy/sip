<?php

class Event_model extends CI_Model
{
	Public function getEvents()
	{
		
	$sql = "SELECT * FROM tb_event WHERE tb_event.start BETWEEN ? AND ? ORDER BY tb_event.start ASC";
	return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();
//        $sql = "SELECT * FROM tb_event WHERE tb_event.start BETWEEN '2018-07-16' AND '2018-07-17' ORDER BY tb_event.start ASC";
//	return $this->db->query($sql);
        

	}

/*Create new events */

	Public function addEvent()
	{

	$sql = "INSERT INTO tb_event  (tb_event.title,tb_event.start,tb_event.end,tb_event.description, tb_event.color) VALUES (?,?,?,?,?)";
	$this->db->query($sql, array($_POST['title'], $_POST['start'],$_POST['end'], $_POST['description'], $_POST['color']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

        
        
	/*Update  event */

	Public function updateEvent()
	{

	$sql = "UPDATE tb_event SET tb_event.title = ?, tb_event.description = ?, tb_event.color = ? WHERE id = ?";
	$this->db->query($sql, array($_POST['title'],$_POST['description'], $_POST['color'], $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}


	/*Delete event */

	Public function deleteEvent()
	{

	$sql = "DELETE FROM tb_event WHERE id = ?";
	$this->db->query($sql, array($_GET['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function dragUpdateEvent()
	{
			//$date=date('Y-m-d h:i:s',strtotime($_POST['date']));

			$sql = "UPDATE tb_event SET  tb_event.start = ? ,tb_event.end = ?  WHERE id = ?";
			$this->db->query($sql, array($_POST['start'],$_POST['end'], $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;


	}

        function addEventTemp($data,$id)
	{
            if($this->db->where('id',$id)->get('tb_event_temp')->num_rows()>0)
            {
                //return false;
            }
            else
            {
                $this->db->insert('tb_event_temp', $data);
            }
           
	}
        
        public function getEventTempById($id)
        {
//            
//            $sql = "SELECT * FROM tb_event_temp WHERE id = ? ORDER BY start ASC";
//            return $this->db->query($sql,array($id))->result();
            
            return $this->db->where('id',$id)->get('tb_event_temp')->result();
        }
        public function getEventTemp()
        {
            return $this->db
                    ->where('start >=',$_GET['start'])
                    ->where('end <=', $_GET['end'])
                    ->get('tb_event_temp')
                    ->result();
        }
        function getLastIdEventTemp()
	{
		$query = $this->db->select_max('id')
			->get('tb_event_temp')
			->row();
		return $query->id;
	}
        
        
}

?>
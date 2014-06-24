<?php
class db extends mysqli {
	public function __construct ( $host, $user, $pass, $db ) {
		global $sy;
		parent::__construct( $host, $user, $pass, $db );
			if ( $this->connect_error ) {
				$error_msg = 'DB Connection Error ( No : ' . $this->connect_errno . ' message : ' .$this->connect_error.')';
				$sy['debug']->log($error_msg);
				die ( $error_msg );
			}
			else $sy['debug']->log("DB Connected Successfully.");
	}
	public function query ( $query ) {
		global $sy;
		$sy['debug']->log('DB QUERY - '.$query);
		if ( $result = parent::query( $query ) ) {
			return $result;
		}
		else {
			$sy['debug']->log('DB QUERY ERROR - '.$this->error);
		}
	}
	
	public function row ( $query ) {
		$result = $this->query($query. " LIMIT 1");
		$row = $result->fetch_assoc();
		$result->close();
		return $row;
	}
	
	
	public function rows ( $query ) {
		$result = $this->query($query);
		
		$rows = array();
		while ( $row = $result->fetch_assoc() ) {
			$rows[] = $row;
		}
		$result->close();
		
		return $rows;
	}
	
	public function count( $table, $option ) {
		$conds = array();
		foreach ( $option as $key => $value ) {
			$conds[] = "`".$key."`='".$value."'";
		}
		$query = "SELECT COUNT(*) as cnt FROM $table WHERE ". implode(' AND ', $conds );
		
		$row = $this->row($query);
		return $row['cnt'];
		
	}
	
	public function insert($table, $option ) {
		$f = array();
		$v = array();
		foreach ( $option as $key => $value ) {
			$f[] = "`".$key."`";
			$v[] = "'".$this->escape($value)."'";
		}
		$field = "(".implode(",", $f).")";
		$values = "VALUES (".implode(",", $v).")";
		$query = "INSERT INTO $table $field $values";
		$this->query($query);
		
		return $this->insert_id;
	}
	
	
	public function delete($table, $option ) {
		$conds = array();
		foreach ( $option as $key => $value ) {
			$conds[] = "`$key` = '$value'";
		}
		$where = "WHERE " . implode( "AND ", $conds );
		$query = "DELETE FROM $table $where";
		
		return $this->query( $query );
	}
	
	public function update( $table, $option, $condition ) {
		$conds = array();
		$up = array();
		foreach ( $option as $key => $value ) {
			$up[] = "`$key` = '".$value."'";
		}
		
		foreach ( $condition as $key => $value ) {
			$conds[] = "`$key` = '" . $value . "'";
		}
	
		$update_value = " SET " . implode( " , ", $up );
		$where = "WHERE " . implode ( " AND ", $conds );
		
		$query = "UPDATE $table $update_value $where";
		
		return $this->query( $query );
	}
	
	public function fields ( $table_name ) {
		
		$query = "SHOW COLUMNS FROM $table_name";
		$rows = $this->rows($query);
		
		$fields = array();
		foreach( $rows as $row ) {
			$fields[] = $row['Field'];
		}
		
		return $fields;
	}
	
	public function escape( $value ) {
		return $this->real_escape_string($value);
	}
	
	public function db_close() {
		$this->close();
	}
}
?>
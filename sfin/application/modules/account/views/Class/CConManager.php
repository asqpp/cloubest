<?php
class CConManager
{

    public function __construct()
    {

        $CI =& get_instance();
        $CI->load->database('dbname');

        $this->conn=mysqli_connect($CI->db->hostname,$CI->db->username,$CI->db->password,$CI->db->database) or die( "Unable to Connect: ".mysqli_connect_error());
    }
    public function Open()
    {
   
        mysqli_query($this->conn,"SET NAMES 'utf8'" );
        mysqli_query($this->conn,"SET CHARACTER SET utf8" );
        mysqli_query( $this->conn,"SET CHARACTER_SET_CONNECTION=utf8");
        mysqli_query($this->conn, "SET SQL_MODE = ''");
        return TRUE;
    }

    public function getLastId()
    {
        return mysqli_insert_id($this->conn);
    }

    public function query($sql, $params = array())
    {
        try
        {
            // SECURITY FIX: Support prepared statements to prevent SQL injection
            if (!empty($params)) {
                // Use prepared statements when parameters are provided
                $stmt = mysqli_prepare($this->conn, $sql);
                if (!$stmt) {
                    $oResult = new CResult();
                    $oResult->message = mysqli_error($this->conn);
                    $oResult->error = mysqli_errno($this->conn);
                    $oResult->IsSucess = FALSE;
                    return $oResult;
                }

                // Bind parameters dynamically
                if (!empty($params)) {
                    $types = str_repeat('s', count($params)); // Default to string type
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }

                mysqli_stmt_execute($stmt);
                $resource = mysqli_stmt_get_result($stmt);

                if ($resource === FALSE && mysqli_stmt_affected_rows($stmt) >= 0) {
                    // Non-SELECT query (INSERT, UPDATE, DELETE)
                    $oResult = new CResult();
                    $oResult->effected_row = mysqli_stmt_affected_rows($stmt);
                    $oResult->IsSucess = TRUE;
                    mysqli_stmt_close($stmt);
                    return $oResult;
                }
                mysqli_stmt_close($stmt);
            } else {
                // Legacy mode: direct query (use only for queries without user input)
                $resource = mysqli_query($this->conn, $sql);
            }

            if ($resource)
            {
                if ($resource instanceof mysqli_result)
                {
                    $i = 0;
                    $data = array();
                    while ($result = mysqli_fetch_assoc($resource))
                    {
                        $data[$i] = $result;
                        $i++;
                    }
                    mysqli_free_result($resource);
                    $oResult = new CResult();
                    $oResult->row = isset($data[0]) ? $data[0] : array();
                    $oResult->rows = $data;
                    $oResult->num_rows = $i;
                    $oResult->IsSucess=TRUE;
                    unset($data);
                    return $oResult;
                }
                else
                {
                    $oResult = new CResult();

                    $oResult->effected_row=mysqli_affected_rows($this->conn);

                    $oResult->IsSucess=TRUE;

                    return $oResult;


                }
            }
            else
            {
                $oResult=new CResult();
                $oResult->message=mysqli_error($this->conn);
                $oResult->error=mysqli_errno($this->conn);
                $oResult->IsSucess=FALSE;
                return $oResult;
            }
        }
        catch(Exception $e)
        {
            $oResult=new CResult();
            $oResult->message=$e->getMessage();
            $oResult->error=$e->getCode();
            $oResult->IsSucess=FALSE;
            return $oResult;
        }
    }
    public function Close()
    {
        mysqli_close($this->conn);
    }
}
?>
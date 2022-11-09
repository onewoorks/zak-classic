<?php

// include_once '../../../includes/config.php';

class aliranbank_model {

    public $values = array();
    private $user_id;
    private $abid;
    private $atid;

    private $db;

    public function __construct(){
        $this->db = new Connection();
    }

    private function sortDate($date) {
        $a = explode('-', $date);
        return $a[2] . '-' . $a[0] . '-' . $a[1];
    }


    private function getLastAliranBankId() {
        $a = $this->db->execute("SELECT max(id) AS id FROM aliranbank");
        $result = '';
        while ($b = mysqli_fetch_array($a)):
            $result = $b['id'];
        endwhile;
        return $result;
    }

    private function getLastAliranTunaiId() {
        $a = $this->db->execute("SELECT max(at_id) AS id FROM tbl_alirantunai");
        $result = '';
        while ($b = mysqli_fetch_array($a)):
            $result = $b['id'];
        endwhile;
        return $result;
    }

    function create_aliranbank() {
        $value = $this->values;
        $user_id = (int) $this->user_id;
        $this->db->execute("INSERT INTO aliranbank (perkara,jumlah,kategori,user_id) VALUES ('$value[0]','$value[1]','$value[2]', $user_id)");
    }

    function create_alirantunai() {
        $value = $this->values;
        $ab_id = $this->getLastAliranBankId();
        $this->db->execute("INSERT INTO tbl_alirantunai (at_perkara,at_kategori,at_jumlah,stf_id,ref_ab_id) VALUES('$value[0]',1,'$value[1]',68,'$ab_id')");
        $this->update_aliranbank();
    }

    private function update_aliranbank() {
        $atid = $this->getLastAliranTunaiId();
        $abid = $this->getLastAliranBankId();
        $this->db->execute("UPDATE aliranbank SET ref_at_id='$atid' WHERE id='$abid'");
    }

    function read_aliranbank_ikut_tarikh() {
        $value = $this->values;
        $startDate = $this->sortDate($value[0]);
        $endDate = $this->sortDate($value[1]);
        $a = $this->db->execute("SELECT * FROM aliranbank WHERE date(timestamp)>= '$startDate' AND date(timestamp)<='$endDate' order by timestamp desc");
        $result = array();
        while ($b = mysqli_fetch_array($a)) {
            $result[] = array('id' => $b['id'], 'timestamp' => $b['timestamp'], 'perkara' => $b['perkara'], 'jumlah' => $b['jumlah'], 'kategori' => $b['kategori']);
        }
        return $result;
    }

    function read_aliranbank_criteria($criteria = 'all') {
        $sql_append = '';
        switch ($criteria):
            case 'all';
                $sql_append = '1';
                break;
            case 'bulanini':
                $sql_append = 'MONTH(timestamp)=MONTH(now()) AND YEAR(timestamp)=YEAR(now())';
                break;
        endswitch;
        $a = $this->db->execute("SELECT * FROM aliranbank WHERE $sql_append");
        $result = array();
        while ($b = mysqli_fetch_array($a)) {
            $result[] = array('id' => $b['id'], 'timestamp' => $b['timestamp'], 'perkara' => $b['perkara'], 'jumlah' => $b['jumlah'], 'kategori' => $b['kategori']);
        }
        return $result;
    }

    function delete_aliranbank_id() {
        $id = $this->values;
        $this->db->execute("DELETE FROM aliranbank WHERE id='$id'");
        $this->db->execute("DELETE FROM tbl_alirantunai WHERE ref_ab_id='$id'");
    }

}


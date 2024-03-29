<?php
// extends class Model
class AbsenM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tbabsen
  public function add_absen($id_jadwal, $id_qr, $nim){
    if(empty($id_jadwal) || empty($id_qr) || empty($nim)){
      return $this->empty_response();
    }else{
      $data = array(
        "id_jadwal"=>$id_jadwal,
        "id_qr"=>$id_qr,
        "nim"=>nim
      );
      $insert = $this->db->insert("tbabsen", $data);
      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data absen ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal ditambahkan.';
        return $response;
      }
    }
  }

  // mengambil semua data absen
  public function all_absen(){
    $all = $this->db->get("tbabsen")->result();
    $response['status']=200;
    $response['error']=false;
    $response['absen']=$all;
    return $response;
  }

  // mengambil data absen
  public function the_absen($id_absen){
    if($id_absen == ''){
      $all = $this->db->get("tbabsen")->result();
      $response['status']=200;
      $response['error']=false;
      $response['absen']=$all;
      return $response;
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $this->db->where($where);
      $theid = $this->db->get("tbabsen")->result();
      if($theid){
        $response['status']=200;
        $response['error']=false;
        $response['absen']=$theid;
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal ditampilkan.';
        return $response;
      }
    }
  }

  
  // hapus data absen
  public function delete_absen($id_absen){
    if($id_absen == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $this->db->where($where);
      $delete = $this->db->delete("tbabsen");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data absen dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal dihapus.';
        return $response;
      }
    }
  }

  // update absen
  public function update_absen($id_absen, $id_jadwal, $id_qr, $nim, $waktu){
    if( empty($id_absen) || empty($id_jadwal) || $id_qr == '' || empty($nim) || empty($waktu) ){
      return $this->empty_response();
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $set = array(
        "id_jadwal"=>$id_jadwal,
        "id_qr"=>$id_qr,
        "nim"=>$nim,
        "waktu"=>$waktu
      );
      $this->db->where($where);
      $update = $this->db->update("tbabsen",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data absen diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal diubah.';
        return $response;
      }
    }
  }
}

?>
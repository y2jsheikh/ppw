<?php
// Run command "composer dump-autoload"
use Illuminate\Support\Facades\DB;

if(!function_exists('show_dropdown')) {
    function show_dropdown($table_name, $s_name, $o_name, $o_id = "id", $selected = 0, $default_select = '', $attr = '', $where = '', $sort_order = '', $group_by = '') {
        $output = '';
    //    $where = ($where != "") ? $where : "";
    //    $group_by = ($group_by != "") ? $group_by : "";
        $sort_order = ($sort_order != "") ? " ORDER BY $sort_order" : "";
    //    $sql = "SELECT * FROM " . $CI->db->dbprefix . $table_name . " $where $sort_order $group_by";
    //    $query = $CI->db->query($sql);

        if(!empty($where) && !empty($group_by)){
            $query = DB::table($table_name)
                ->select(DB::raw('*'))
                ->where($where)
                ->groupBy($group_by)
                ->get();
        }

        if(!empty($group_by)){
            $query = DB::table($table_name)
                ->select(DB::raw('*'))
                ->groupBy($group_by)
                ->get();
        }

        if(!empty($where)){
            $query = DB::table($table_name)
                ->select(DB::raw('*'))
                ->where($where)->get();
        }

        if (empty($where)) {
            $query = DB::table($table_name)
                ->select(DB::raw('*'))->get();
        }

        if (substr($s_name, -2) == "[]")
            $s_name_id = str_replace("]", "", str_replace("[", "", $s_name));
        else
            $s_name_id = $s_name;
        $output .= "<select id='" . $s_name_id . "' name='" . $s_name . "' " . $attr . " >";
        if ($default_select != "")
            $output .= "<option value=''>" . $default_select . "</option>";
        foreach ($query as $o) {
            if(is_array($selected) && in_array($o->$o_id, $selected)){
                $output .= "<option selected=\"selected\" value=\"" . $o->$o_id . "\" >" . ucfirst($o->$o_name) . "</option>";
            }else if ($o->$o_id == $selected ){
                $output .= "<option selected=\"selected\" value=\"" . $o->$o_id . "\" >" . ucfirst($o->$o_name) . "</option>";
            }else{
                $output .= "<option value=\"" . $o->$o_id . "\" >" . ucfirst($o->$o_name) . "</option>";
            }
        }
        $output .= "</select>";
        return $output;
    }
}

if(!function_exists('pre')) {
    function pre($arr, $e = 0, $msg = '', $isHidden = 0){
        if ($isHidden) {
            echo "<!--";
        }
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
        if ($msg != '') {
            echo $msg;
        }
        if ($e == 1) {
            exit;
        }
        if ($isHidden) {
            echo "-->";
        }
    }
}

if(!function_exists('contact_send_email')) {
    function contact_send_email($data = array()) {
        app('App\Http\Controllers\MailController')->html_email('contact_mail', $data);
    }
}

if(!function_exists('getsinglefield')) {
    function getsinglefield($tbl, $field, $where = '') {
        $result = DB::select("SELECT $field FROM " . $tbl. " ".$where);
        return $result[0]->$field;
//        $CI = & get_instance();
//        $result = $CI->db->query("SELECT $field FROM " . $CI->db->dbprefix . $tbl . " $where");
//        $result = $result->row();
//        return $result->$field;
    }
}

?>
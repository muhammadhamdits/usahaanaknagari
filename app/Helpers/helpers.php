<?php

function formInputRow($label, $type, $name, $placeholder, $required, $old, $message, $col=8, $opt=null){
    if($message){
        $error = 'is-invalid';
    }else{
        $error = '';
    }
    return "
    <div class='row justify-content-center'>
        <div class='col-$col form-group'>
            <label for='$name'>$label:</label>
            <input type='$type' name='$name' id='$name' class='form-control $error' value='$old' placeholder='Masukkan $placeholder ...' $required $opt>
            <p class='text-danger text-sm'>$message</p>
        </div>
    </div>";
}

function formInputCol($label, $type, $name, $placeholder, $required, $old, $message, $label2, $type2, $name2, $placeholder2, $required2, $old2, $message2, $col=4, $opt1=null, $opt2=null){
    if($message){
        $error = 'is-invalid';
    }else{
        $error = '';
    }
    if($message2){
        $error2 = 'is-invalid';
    }else{
        $error2 = '';
    }
    return "
    <div class='row justify-content-center'>
        <div class='col-md-$col form-group'>
            <label for='$name'>$label:</label>
            <input type='$type' name='$name' id='$name' class='form-control $error' value='$old' placeholder='Masukkan $placeholder ...' $required $opt1>
            <p class='text-danger text-sm'>$message</p>
        </div>
        <div class='col-md-$col form-group'>
            <label for='$name2'>$label2:</label>
            <input type='$type2' name='$name2' id='$name2' class='form-control $error2' value='$old2' placeholder='Masukkan $placeholder2 ...' $required2 $opt2>
            <p class='text-danger text-sm'>$message2</p>
        </div>
    </div>";
}

function formSelect($label, $name, $options, $selected=null){
    $element = "
    <div class='row justify-content-center mb-3'>
        <div class='col-12 form-group'>
            <label for='$name'>$label:</label>
            <select name='$name' id='$name' class='form-control select2'>";
                foreach($options as $value => $option){
                    $element .= "
                    <option value='".($value+1)."'>$option</option>";
                }
                $element .= "
            </select>
        </div>
    </div>";

    return $element;
}

function formText($label, $name, $required, $old, $message, $col=8){
    if($message){
        $error = 'is-invalid';
    }else{
        $error = '';
    }
    return "
    <div class='row justify-content-center'>
        <div class='col-$col form-group'>
            <label for='$name'>$label:</label>
            <textarea name='$name' id='$name' rows='3' class='form-control $error' placeholder='Masukkan $label ...' $required>$old</textarea>
            <p class='text-danger text-sm'>$message</p>
        </div>
    </div>";
}

function format_tgl_indonesia($tanggal){
    if($tanggal){
        $bulan = [
            1 =>   
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        
        $pecah = explode('-', $tanggal);
        
        return $pecah[2] . ' ' . $bulan[ (int)$pecah[1] ] . ' ' . $pecah[0];
    }
    return '-';
}
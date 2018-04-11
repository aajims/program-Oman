	<div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 Aplikasi Keuangan SMP 1 Cikande | Design by : Nurohman
                </div>
        </div>
        
    <script type="text/javascript" src="<?=base_url();?>assets/bootstrap/js/jquery.autocomplete.js"></script>    
	<script type="text/javascript" src="<?=base_url();?>assets/bootstrap/js/jquery.form-validator.min.js"></script>
    
    <script>
	var myLanguage = {
      errorTitle : 'Tidak dapat dilanjutkan!',
      requiredFields : 'inputan ini harus di isi',
      badTime : 'Harus format waktu',
      badEmail : 'Data Harus format email',
      badTelephone : 'Harus format telepon',
      badSecurityAnswer : 'Pertanyaan keamanan salah',
      badDate : 'Kesalahan menulis tanggal',
      lengthBadStart : 'Harus input karakter antara ',
      lengthBadEnd : ' Karakter',
      lengthTooLongStart : 'Panjang karakter harus Kurang dari ',
      lengthTooShortStart : 'Panjang karakter harus Minimal ',
      notConfirmed : 'Konfirmasi terlebih dahulu',
      badDomain : 'Harus format nama domain',
      badUrl : 'Harus format URL',
      badCustomVal : 'You gave an incorrect answer',
      badInt : 'Harus karakter angka',
      badSecurityNumber : 'Your social security number was incorrect',
      badUKVatAnswer : 'Incorrect UK VAT Number',
      badStrength : 'The password isn\'t strong enough',
      badNumberOfSelectedOptionsStart : 'You have to choose at least ',
      badNumberOfSelectedOptionsEnd : ' answers',
      badAlphaNumeric : 'The answer you gave must contain only alphanumeric characters ',
      badAlphaNumericExtra: ' and ',
      wrongFileSize : 'The file you are trying to upload is too large',
      wrongFileType : 'The file you are trying to upload is of wrong type',
      groupCheckedRangeStart : 'Please choose between ',
      groupCheckedTooFewStart : 'Please choose at least ',
      groupCheckedTooManyStart : 'Please choose a maximum of ',
      groupCheckedEnd : ' item(s)'
    };
	$.validate({
    language : myLanguage
  	});
    </script>
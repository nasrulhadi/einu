$(document).ready(function() { 
	$.fn.fancyzoom.defaultsOptions.imgDir='fancyzoom/ressources/'; 
	$('.product_box a').focus(function() { $('.product_box a').fancyzoom({overlay:0.8}); });
	$('#customer_login').submit(function() {
		var username = $('#username').val();
		var password = $('#password').val();
		
		// email validation
		if (!username){
			$('#lr').html('Mohon isi username login');
			return false;	
		} else if (!password){
			$('#lr').html('Mohon isi password anda');
			return false;	
		}

		// loader while data submission
		$('#lr').html("Loading...");
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#lr').html(data);
			}
		})
		return false;
	});
	$('#newsletter_form').submit(function() {
		var email = $('#email').val();
		var regExmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		// email validation
		if (!email){
			$('#nr').html('Email anda masih kosong');
			return false;	
		} else if (!regExmail.test(email)){
			$('#nr').html('Email anda salah');
			return false;
		}

		// loader while data submission
		$('#nr').html("<img src=\"images/loader.gif\" /> Loading...");
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#nr').html(data);
			}
		})
		return false;
	});
    $(".buyproduct form #banyak").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8) {
                // let it happen, don't do anything
        }
        else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57 ) {
                        event.preventDefault(); 
                }       
        }
    });
	$('.buyproduct form').submit(function() {
		var itemid = $(this).children('#itemid').val();
		var banyak = $(this).children('#banyak').val();
		var angka_pesanan =  parseInt($('#keranjangbarang').text());
		var jumlah_pesan = angka_pesanan+parseInt(banyak)-0;
		$.post("data/beli.php", { itemid: itemid, banyak: banyak },
		   function(data) {
				if (parseInt(data) == 1){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'Barang sudah ada di keranjang belanja.',
						// (string | mandatory) the text inside the notification
						text: 'Barang yang anda pesan sudah ada di keranjang belanja, silahkan update banyak barang yang anda pesan di keranjang belanja anda atau klik di <a href=\'cart.php\' style=\'color: yellow;\'>sini</a>.'
					});
				} else if (parseInt(data) == 2){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'Barang tidak ada di sediakan!',
						// (string | mandatory) the text inside the notification
						text: 'Pastikan anda membeli berproduk id yang telah di sediakan.'
					});
				} else if (parseInt(data) == 3){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'Barang berhasil di tambahkan di keranjang belanja!',
						// (string | mandatory) the text inside the notification
						text: 'Barang yang anda pesan berhasil di tambahkan di keranjang belanja anda, jika anda selesai memesan, silahkan klik di <a href=\'cart.php\' style=\'color: yellow;\'>sini</a>.'
					});
					$('#keranjangbarang').html(jumlah_pesan);
				}
		})
		return false;
	});
    $(".buyproduct form #banyak").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8) {
                // let it happen, don't do anything
        }
        else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57 ) {
                        event.preventDefault(); 
                }       
        }
    });
	$('#slider2').s3Slider({
	timeOut: 4000
	});
	$('a#showbuy').click(function(){
		$(this).next().toggle('fast');
	});
	$('a#showdescription').click(function(){
		$(this).prev().toggle('fast');
	});
});

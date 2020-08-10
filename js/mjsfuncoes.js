	// ==Isaque==Felipe== //
	
  function Alerta_mensagens(){
  
    $("body").prepend("<div id='mmodal'><div class='alerta'><p class='mtexto'><b><?=$mtexto?></b></p><span class='fechar' onclick='Remove_modal()'>x</span></div></div>"
      );
     
  };
  function Remove_modal(){
    $("#mmodal").css('display', 'none')     
    }
  setTimeout(Remove_modal, 5000)

<?php
function translator($stan){
    if ($stan == 'OK') {
        if (formatujGET('lang') == 'pl') { return $translate = 'Zmiana dokonana poprawnie!';}
        if (formatujGET('lang') == 'en') { return $translate='All changes have been saved!' ;}
        if (formatujGET('lang') == 'cs' OR formatujGET('lang') == 'sk' OR formatujGET('lang') == 'cz' ) { return $translate='Všechny změny byly uloženy!'; }
        
        else { return $translate='All changes have been saved!' ;}
    }
    if ($stan == 'BAD') {
        if (formatujGET('lang') == 'pl') { return $translate = 'Coś poszło nie tak!';}
        if (formatujGET('lang') == 'en') { return $translate='Something went wrong!' ;}
        if (formatujGET('lang') == 'cs' OR formatujGET('lang') == 'sk' OR formatujGET('lang') == 'cz' ) { return $translate='Něco se pokazilo!'; }
        
        else { return $translate='Something went wrong!' ;}
    }
    }
    
    class notice {
      //'error', 'warning', 'success'
    function showAlertOK(){
    
        echo '
        <script>
        new Notify ({
          status: \'success\',
          title: \'success\',
          text: \''.translator('OK').'\',
          effect: \'fade\',
          speed: 300,
          customClass: \'\',
          customIcon: \'\',
          showIcon: true,
          showCloseButton: true,
          autoclose: \'true\',
          autotimeout: 4000,
          gap: 20,
          distance: 20,
          type: 1,
          position: \'right top\'
        })
      
      
      </script>
        
        ' ;


    }
    
    function showAlertBad(){
    
        echo '
        <script>
        new Notify ({
          status: \'error\',
          title: \'error\',
          text: \''.translator('BAD').'\',
          effect: \'fade\',
          speed: 300,
          customClass: \'\',
          customIcon: \'\',
          showIcon: true,
          showCloseButton: true,
          autoclose: \'false\',
          autotimeout: 4000,
          gap: 20,
          distance: 20,
          type: 1,
          position: \'right top\'
        })
      
      
      </script>
        
        ' ;


    }
    
    
    }
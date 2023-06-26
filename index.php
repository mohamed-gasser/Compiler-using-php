<!DOCTYPE html>
<html >
<head>
  
  <meta charset="UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    
  
  
   <title>My own Language</title>
   
</head>
<body>
  <div class="header">
    <h1>My Lang</h1>
    <button  class="run" id="run" >Scan</button>
    <button id="upload"  class="Browse" >Browse</button>
    <button class="Parse" id="Parse" >Parse</button>
    <pre id="textarea"  hidden="hidden;" ></pre>
    
    
  </div>

    <textarea aria-autocomplete="both" autocomplete="off" class="first" type="text" id="text_complier"  spellcheck="false" ></textarea><br/>
   
    <textarea id="Navigation" style="resize: none;overflow: hidden;display: block ;color: 
    white;padding: 0.5em;width:30vw;height: 4vw;margin: 2rem 10rem;background-color: rgb(35, 35, 82);" placeholder="Test Navigation......."></textarea>
    
    <button class="Navigation" id="test_Navigation" style="margin: 1rem 10rem;width: 9rem;margin-top:-5px ;
  height: 4rem;background-color: rgb(204,2,255);border:none;border-radius: 0.8rem;cursor: pointer;" >Test Navigation</button>

  <p id="value" ></p>
  <h3 class="ouput-header">Editor Output</h3>
  <div class="code-output" id="code-output"><br/><br/><br/><br/></div>



  <h3 class="ouput-header">Browse Output</h3>
  <div class="code-output" id="Browse-output" style="background-color: black; color:white;"><br/><br/><br/><br/></div>
  
  <script type="text/javascript"  src="jquery.min.js"></script>
  <script src="CodeMirror/lib/codemirror.js"></script>
   <link  rel="stylesheet" href="CodeMirror/lib/codemirror.css">
   <link rel="stylesheet"  href="CodeMirror/theme/darcula.css">
   <script src="CodeMirror/addon/edit/matchbrackets.js"></script>

   <script src="Script/4aker.js"></script>
   <script src="CodeMirror/addon/hint/show-hint.js"></script>
   <link  rel="stylesheet" href="CodeMirror/addon/hint/show-hint.css">

 
    <script>
      $("#run").click(function(){
        var name= editor.getValue();
      
        $.post( "runscanner.php",
        {
          name1:name,
          
        }
        ,function( data ) {
          for (let i = 0; i < data.length; i++) {
              data = data.replace("<br>", "\n") ; }
          document.getElementById("code-output").innerText = data ;
        });
            
        
      });


      $("#Parse").click(function(){
        var name= editor.getValue();
      
        $.post( "runparse.php",
        {
          name1:name,
          
        }
        ,function( data ) {
          for (let i = 0; i < data.length; i++) {
              data = data.replace("<br>", "\n") ; }
          document.getElementById("code-output").innerText = data ;
        });
            
        
      });
      var storedItem = localStorage.getItem("storedItem");
    $(document).ready(function(){
      $(".CodeMirror").keypress(function(){
                  const digit = ["0","1","2","3","4","5","6","7","8","9"] ; 
                  const digit2 = ["0","1","2","3","4","5","6","7","8","9"] ;
                  const number = digit.flatMap(d => digit2.map(v => d + v));
                  const Keywords=["Type","Infer","If","Else","Ipok","Sipok","Craf","Sequence","Ipokf","Sipokf",
            "Valueless","Rational","Endthis","However","When","Respondwith","Srap","Scan","Conditionof","Sequence","@","^",
            "*","+","/","-","&&","||","~","==","#","!=",">","<",">=","<=","=","->","{","[","}","]","Require","“","’","$" , ";" ,"," ,"(" ,")"];
            var item = editor.getValue();
            localStorage.setItem("storedItem" , item) ;
            for (let i = 0; i < item.length; i++) {
              item = item.replace("\n", "") ; }
            const myArray = item.split(/(\s+)/);
            console.log(myArray);
            for (let index = 0; index < myArray.length; index++) {
              if(Keywords.includes(myArray[index]) || number.includes(myArray[index]) ){
                  console.log(myArray[index]);
                  var sheet = document.createElement('style')
                  sheet.innerText = " .CodeMirror {text-decoration:  underline 1px  #2B2B2B;}";
                  document.body.appendChild(sheet);
                  document.getElementById("text_complier").innerText = myArray[index] ;
                }
                else if(!Keywords.includes(myArray[index])){
                  console.log("notfound");
                  var sheet2 = document.createElement('style')
                  sheet2.innerText = " .CodeMirror {text-decoration:  underline 1px red ;}";
                  document.body.appendChild(sheet2);
                  document.getElementById("text_complier").innerText = myArray[index] ; 
                }
              } 
    });
  });

      $("#upload").click(async function(){
        [fileHandle] = await window.showOpenFilePicker() ;
          let fileData = await fileHandle.getFile();
        
          let text = await fileData.text() ; 
      
        $.post( "runscanner.php",
        {
          name1:text,
          
        }
        ,function( data ) {
          for (let i = 0; i < data.length; i++) {
              data = data.replace("<br>", "\n") ; }
          document.getElementById("Browse-output").innerText = data ;
        });
            
        
      });




      $("#test_Navigation").click(function(){
     
        var item = editor.getValue();
        var filepath = null;
        for (let i = 0; i < item.length; i++) {
              item = item.replace("\n", "") ; }
        for (let i = 0; i < item.length; i++) {
              item = item.replace(";", "") ; }
        const myArray = item.split(" ");
            for (let index = 0; index < myArray.length -1; index++) {
              if("Require".includes(myArray[index])){
                filepath =   myArray[index+2];
                }
            }
        fetch(filepath)
        .then(function(response){
          return response.text() ;
        })
        .then(function(data){
          Navigation(data) ;
        })
        
      
    });

      var editor = CodeMirror.fromTextArea(document.getElementById('text_complier'),{
            mode:"python",
            theme:"darcula",
            lineNumbers:true,
            lineWrapping:true,
            matchBrackets: true,
            onHighlightComplete:true,
            extraKeys:{"Shift-Space":"autocomplete"}
            

  });
        function Navigation(text){

      var item = text;
      var index2;
      var index3;
      var array = [];
      var array2 = [];

      var txt=document.getElementById("Navigation");
      var valueText=txt.value;
      localStorage.setItem("storedItem" , item) ;
      for (let i = 0; i < item.length; i++) {
          item = item.replace("\n", " ") ;
          item = item.replace("\r", "") ;
                }
      const myArray = item.split(" ");

      for (let index = 0; index < myArray.length; index++) {

        if(myArray[index]==valueText){
          if (myArray[index-1]=="") {
          index2=index;
            array.push(myArray[index-1]+" ")
            array.push(myArray[index]);
          }
          else  {
          index2=index;
            array.push(myArray[index-2]+" ");
            array.push(myArray[index-1]+" ")
            array.push(myArray[index]);
      
          }

        }
        
      }

        var opens=[];
        var closes=[];
      for (let index = index2; index < myArray.length; index++) {

        if (myArray[index] == '{'){
          opens.push(myArray[index]);
        }
        if (myArray[index] == '}'){
          closes.push(myArray[index]);
        }
        if (( opens.length+closes.length) > 0 &&  opens.length==closes.length) {
          array.push(myArray[index+1]);
        break;
        }
        if (( opens.length+closes.length) == 0 || opens.length!=closes.length){
        array.push(myArray[index+1]);
      
      }

      }

      var stm="";
      for (var i = 0; i < array.length; i++) {
      if (array[i]=="") {
      stm=stm+"\n";
      }
      stm=stm+array[i];

      }
      document.getElementById("code-output").innerText = stm ;
      }
         
    </script>
</body>

</html>
<script type="text/javascript">

name="lmo3";
img0 = new Image();
img0.src = "<?=URL_TO_IMGDIR?>/lmo-admin0.gif";
img1 = new Image();
img1.src = "<?=URL_TO_IMGDIR?>/lmo-admin1.gif";
img2 = new Image();
img2.src = "<?=URL_TO_IMGDIR?>/lmo-admin2.gif";
img3 = new Image();
img3.src = "<?=URL_TO_IMGDIR?>/lmo-admin3.gif";
img4 = new Image();
img4.src = "<?=URL_TO_IMGDIR?>/lmo-admin4.gif";
img5 = new Image();
img5.src = "<?=URL_TO_IMGDIR?>/lmo-admin5.gif";
var lmotest=true;

function lmoimg (x,y){
  document.getElementsByName("ximg"+x)[0].src = y.src;
  }
function lmotorclk(x,y,z){
  if(document.all && !window.opera){
    if(z==38){lmotorauf(x,y,1);}
    if(z==40){lmotorauf(x,y,-1);}
    }
  }
function lmoteamauf(x,z){
  var a=document.getElementsByName(x)[0].value;
  if(isNaN(a)==true){a=0;}else{a=parseInt(a);}
  if(a>40){a=40;}
  if(a<4){a=4;}
  if((z==1) && (a<40)){a++;}
  if((z==-1) && (a>4)){a--;}
  document.getElementsByName(x)[0].value=a;
  lmotest=false;
  }
function lmoteamclk(x,z){
  if(document.all && !window.opera){
    if(z==38){lmoteamauf(x,1);}
    if(z==40){lmoteamauf(x,-1);}
    }
  }
function lmoanzstauf(x,z){
  var a=document.getElementsByName(x)[0].value;
  if(isNaN(a)==true){a=0;}else{a=parseInt(a);}
  if(a>116){a=116;}
  if(a<1){a=1;}
  if((z==1) && (a<116)){a++;}
  if((z==-1) && (a>1)){a--;}
  document.getElementsByName(x)[0].value=a;
  lmotest=false;
  }
function lmoanzstclk(x,z){
  if(document.all && !window.opera){
    if(z==38){lmoanzstauf(x,1);}
    if(z==40){lmoanzstauf(x,-1);}
    }
  }
function lmoanzspauf(x,z){
  var a=document.getElementsByName(x)[0].value;
  if(isNaN(a)==true){a=0;}else{a=parseInt(a);}
  if(a>40){a=40;}
  if(a<1){a=1;}
  if((z==1) && (a<40)){a++;}
  if((z==-1) && (a>1)){a--;}
  document.getElementsByName(x)[0].value=a;
  lmotest=false;
  }
function lmoanzspclk(x,z){
  if(document.all && !window.opera){
    if(z==38){lmoanzspauf(x,1);}
    if(z==40){lmoanzspauf(x,-1);}
    }
  }
function lmotorauf(x,y,z){
  if(x=="a"){xx="b";}
  if(x=="b"){xx="a";}
  var a=document.getElementsByName("xgoal"+x+y)[0].value;
  if(a==""){a="-1";}
  if(a=="_"){a="-1";}
  if(a=="X"){a="-2";}
  if(a=="x"){a="-2";}
  var aa=document.getElementsByName("xgoal"+xx+y)[0].value;
  if(aa==""){aa="-1";}
  if(aa=="_"){aa="-1";}
  var ab=aa;
  if(isNaN(a)==true){a=0;}else{a=parseInt(a);}
  if((z==1) && (a<9999)){a++;}
  if((z==-1) && (a>-1)){a--;}
  if((a>-1) && (aa<0)){aa=0;}
  if((a<0) && (aa>-1)){aa=-1;}
  if(a==-2){a="X";}
  if(a==-1){a="_";}
  document.getElementsByName("xgoal"+x+y)[0].value=a;
  if(ab!=aa){
    if(aa==-1){aa="_";}
    document.getElementsByName("xgoal"+xx+y)[0].value=aa;
    }  
  lmotest=false;
  if(a=="X"){lmotorgte(x,y);}
  }
function lmotorgte(x,y){
  var a=document.getElementsByName("xgoal"+x+y)[0].value;
  if((a=="X") || (a=="x")){
    a="-2";
    if(x=="a"){b=1;c="b";}
    if(x=="b"){b=2;c="a";}
    document.getElementsByName("xgoal"+x+y)[0].value=document.getElementsByName("xgoal"+c+y)[0].value;
    document.getElementsByName("xmsieg"+y)[0].selectedIndex=b;
    }
  lmotest=false;
  }
function lmofilename(){
  var s=document.getElementsByName("xfile")[0].value;
  if(s.length==0){s='noname';}
  s=s.replace(/\\/,"/")
  if(s.lastIndexOf("/")>-1){var t=s.substr(s.lastIndexOf("/")+1,s.length); s=t;}
  if(s.substr(s.length-4,s.length).toLowerCase()==".l98"){var t=s.substr(0,s.length-4); s=t;}
  document.getElementsByName("xfile")[0].value=s;
  lmotest=false;
  }
function lmotitelname(){
  var s=document.getElementsByName("xtitel")[0].value;
  if(s.length==0){s='No Name';}
  document.getElementsByName("xtitel")[0].value=s;
  lmotest=false;
  }
function dolmoedit(){
  lmotest=false;
  }
function chklmopass(){
  if(lmotest == true){
    return confirm("<? echo $text[117] ?>");
  }else{
    return true;
  }
}
function dolmoedi2(a,s){
  var s1=document.getElementsByName(s)[0].value;
  for(var i=1;i<=a;i++){
    if(s!="xplatz"+i){
      var s2=document.getElementsByName("xplatz"+i)[0].value;
      if(s1==s2){
        s3=0;
        s4=0;
        for(var j=1;j<=a;j++){
          s4=s4+j;
          if(s!="xplatz"+j){s3=s3+eval(document.getElementsByName("xplatz"+j)[0].value);}
          }
        document.getElementsByName("xplatz"+i)[0].selectedIndex=parseInt(s4-s3-1);
        }
      }
    }
  lmotest=false;
  }
function chklmopas2(a){
  var r=true;
  if(lmotest == true){
    alert("<? echo $text[117] ?>");
    r=false;
    }
  if(lmotest == false){
    var s3=false;
    for(var i=1;i<a;i++){
      for(var j=i+1;j<=a;j++){
        var s1=document.getElementsByName("xplatz"+i)[0].value;
        var s2=document.getElementsByName("xplatz"+j)[0].value;
        if(s1==s2){s3=true;}
        }
      }
    if(s3 == true){
      alert("<? echo $text[416]; ?>");
      r=false;
      }
    }
  if(r == false){
    return false;
    }
  }
function chklmolink(adresse){
  if(lmotest == false){
    return confirm("<? echo $text[119] ?>");
  }else{
    return true;
  }
}
function siklmolink(adresse){
  return confirm("<? echo $text[249] ?>");
}
function dellmolink(adresse,titel){
  return confirm("<? echo $text[296] ?>:\n"+titel);
}
function emllmolink(adresse,emailaddi){
  if(ema=prompt("<? echo $text[346] ?>",emailaddi)){
    if(ema!=""){
      window.open(adresse+"&madr="+ema,"lmoelm","width=250,height=150,resizable=yes,dependent=yes");
    }
  }
}
function dteamlmolink(adresse,team){
  return confirm("<? echo $text[332] ?>:\n"+team);
}
function ateamlmolink(adresse){
  return confirm("<? echo $text[335] ?>");
}
function opencal(feld,startdat){
  lmocal="<?=URL_TO_LMO?>/lmo-admincal.php?abs=lmoedit&feld="+feld;
  if(startdat!=""){lmocal=lmocal+"&calshow="+startdat;}
  lmowin = window.open(lmocal,"lmocalpop","width=180,height=200,resizable=yes,dependent=yes");
  lmotest=false;
  return false;
}

function blend(it) {
  if (!window.opera && !document.layers) {
    if (it.parentNode.parentNode.parentNode.nextSibling.style.display=="none") {  //einblenden
      if (it.parentNode.parentNode.parentNode.nextSibling.nodeType==1) // richtiges Objekt (IE)
        document.all?it.parentNode.parentNode.parentNode.nextSibling.style.display="inline":it.parentNode.parentNode.parentNode.nextSibling.style.display="table-row-group";
      else if (it.parentNode.parentNode.parentNode.nextSibling.nodeType==3) {       //Leerzeichen ist Textobjekt (Moz), dann n�chsten Knoten
        it.parentNode.parentNode.parentNode.nextSibling.nextSibling.style.display="table-row-group";
      }
      it.lastChild.src="<?=URL_TO_IMGDIR?>/minus.gif";
      it.lastChild.alt="-";
      it.lastChild.title="Sektion ausblenden"; 
    }else{  //ausblenden 
      if (it.parentNode.parentNode.parentNode.nextSibling.nodeType==1) // richtiges Objekt
        it.parentNode.parentNode.parentNode.nextSibling.style.display="none";
      else if (it.parentNode.parentNode.parentNode.nextSibling.nodeType==3)
        it.parentNode.parentNode.parentNode.nextSibling.nextSibling.style.display="none"; //Leerzeichen ist Textobjekt bei Mozilla, dann n�chsten Knoten
      it.lastChild.src="<?=URL_TO_IMGDIR?>/plus.gif";
      it.lastChild.alt="+";
      it.lastChild.title="Sektion einblenden";
    }  
  }
}
function blendall() {
  if (!window.opera && !document.layers) {
    minus=new Image(); minus.src="<?=URL_TO_IMGDIR?>/minus.gif";
    x=document.getElementsByTagName("tbody");
    for (i=0;i<x.length;i++) {
      if (x[i].className=="blend_object") {
        x[i].style.display="none";
      }
    }
  }
}
function blendall2(it) {
  if (!window.opera && !document.layers) {
    x=document.getElementsByTagName("tbody");
    r=0;
    for (i=0;i<x.length;i++) {
      if (x[i].className=="blend_object") {
        if (it.lastChild.alt=="-") {
          x[i].style.display="none";
          document.getElementsByName("blendimg"+r)[0].src="<?=URL_TO_IMGDIR?>/plus.gif";
          document.getElementsByName("blendimg"+r)[0].alt="+";
          document.getElementsByName("blendimg"+r)[0].title="Sektion einblenden";
        }else{
          document.all?x[i].style.display="inline":x[i].style.display="table-row-group";
          document.getElementsByName("blendimg"+r)[0].src="<?=URL_TO_IMGDIR?>/minus.gif";
          document.getElementsByName("blendimg"+r)[0].alt="-";
          document.getElementsByName("blendimg"+r)[0].title="Sektion ausblenden"; 
        }
        r++;
      }
    }
    if (it.lastChild.alt=="-"){
      it.lastChild.src="<?=URL_TO_IMGDIR?>/plus.gif";
      it.lastChild.alt="+";
      it.lastChild.title="Sektion einblenden";
    }else{
      it.lastChild.src="<?=URL_TO_IMGDIR?>/minus.gif";
      it.lastChild.alt="-";
      it.lastChild.title="Sektion ausblenden"; 
    }
  }
}

</script>
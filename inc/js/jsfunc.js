function nodate(date_element) {
date_element.value = '0000-00-00';
}
function loadProgram(url,pname,wd,ht,sx,sy,rs) {
    window.open(url,pname,'width='+wd+',height='+ht+',screenX='+sx+',screenY='+sy+',left='+sx+',top='+sy+',resizable='+rs+',scrollbars=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no');
}
function closeProgram() {
  window.close();
  if (window.opener && !window.opener.closed) {
    window.opener.location.reload();
  } 
}
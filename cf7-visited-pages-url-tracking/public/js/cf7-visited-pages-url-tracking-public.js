 function CF7VPUTsetCookie(name,value,days) {
     var expires = "";
     if (days) {
         var date = new Date();
         date.setTime(date.getTime() + (days*24*60*60*1000));
         expires = "; expires=" + date.toUTCString();
     }
     document.cookie = name + "=" + (value || "")  + expires + "; path=/";
 }
 function CF7VPUTgetCookie(name) {
     var nameEQ = name + "=";
     var ca = document.cookie.split(';');
     for(var i=0;i < ca.length;i++) {
         var c = ca[i];
         while (c.charAt(0)==' ') c = c.substring(1,c.length);
         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
     }
     return null;
 }
 function CF7VPUTeraseCookie(name) {   
     document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
 }
 
 
 window.addEventListener('load', (event) => {
     var current_page = window.location.href;
     var cookie_name  = 'cf7vput_last_visited_pages';
     var cf7vput_last_visited_pages = CF7VPUTgetCookie(cookie_name);
     var days = 1;
     if(cf7vput_last_visited_pages === null)
     {
         const cf7vput_last_visited_pages = [current_page];
         var json_str = JSON.stringify(cf7vput_last_visited_pages);
         CF7VPUTsetCookie(cookie_name,json_str,days);
     }
     else
     {
         var pages = JSON.parse(cf7vput_last_visited_pages);
         var total_page = pages.length;
         if(total_page < 10)
         {
             const newFirstElement = current_page;
             const newArray = [newFirstElement].concat(pages);
             let uniqueChars = newArray.filter((c, index) => {
                 return newArray.indexOf(c) === index;
             });
             var json_str = JSON.stringify(uniqueChars);
             CF7VPUTsetCookie(cookie_name,json_str,days);
 
         }
         else
         {
             var pages = JSON.parse(cf7vput_last_visited_pages);
             let popped = pages.pop();
             const newFirstElement = current_page;
             const newArray = [newFirstElement].concat(pages);
             var json_str = JSON.stringify(newArray);
             CF7VPUTsetCookie(cookie_name,json_str,days);
         }
     }
 }); 

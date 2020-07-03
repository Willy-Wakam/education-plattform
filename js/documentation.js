function autocomplete(doc) {
  let inp = $("#doc-search-input");
  let inpHtml = document.getElementById("doc-search-input");
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;

  /*execute a function when someone writes in the text field:*/
  inpHtml.addEventListener("input", function(e) {
    $('#doc-dropdown-menu').addClass('d-none');

    var a, b, i, val = this.value;

    /*close any already open lists of autocompleted values*/
    closeAllLists();
        
    if (!val) { return false;}
    currentFocus = -1;

    /*for each item in the array...*/
    for(let cath in doc) {
      let arr = doc[cath];
      alert(JSON.stringify(cath))
      
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("h6");

      for (i = 0; i < arr.length; i++) {
        let current = arr[i];

        /*check if the item starts with the same letters as the text field value:*/
        let check = current.type.match(new RegExp(val, 'gmi'));
        alert(JSON.stringify(check))

        if (check != null) {
          alert()

          a.setAttribute("id", cath + "-dropdown-title");
          a.setAttribute("class", "dropdown-title");
          /*append the DIV element as a child of the autocomplete container:*/
          $('#doc-dropdown-menu').append(a);

                /*create a DIV element for each matching element:*/
          b = document.createElement("a");
          b.setAttribute("class", "dropdown-item");
          /*make the matching letters bold:*/
          b.innerHTML = "<h6>" + current.type.substr(0, val.length) + "</h6>";
          b.innerHTML += current.type.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input class='doc-hidden-input' type='hidden' value='" + current.type + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.click(function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = $("#doc-hidden-input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }

      c = document.createElement("DIV");
      c.setAttribute("class", "dropdown-divider");
      a.appendChild(c);            
    };
  });


  /*execute a function presses a key on the keyboard:*/
  inp.keydown(function(e) {
      var x = $('#doc-dropdown-menu > a');
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });


  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("active");
  }


  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("active");
    }
  }


  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("dropdown-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inpHtml) {
          x[i].parentNode.removeChild(x[i]);
      }
    }
  }


  /*execute a function when someone clicks in the document:*/
  $('#doc-search-input').focusout(function (e) {
    /*close any already open lists of autocompleted values*/
    closeAllLists(e.target);
    $('#doc-dropdown-menu').addClass('d-none')
  });
}

let doc = {
  start: [],
  components: [
      {
          type: "Image",
      },
      {
          type: "Rectangle",
      }
  ],
}

$(function () {
  autocomplete(doc);
});
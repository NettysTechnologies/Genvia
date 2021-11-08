/*let valuesNumbers = Array();
    let valuesString = Array();
    d3.csv("csvToPdf/souhrnne_vysledky.csv").then(function(data) {
        data.forEach(value => {
            let result = Object.keys(value).map((key) => [Number(key), value[key]]);
            let splitValues = result[0][1].split(";");

            let count = 0;

            splitValues.forEach(numbers => {
                if (numbers.search(/[?!a-zA-Z]/)) {
                    valuesNumbers.push([count++, parseInt(numbers)]);
                }
            });

            splitValues.forEach(string => {
                if (string.search(/[?!0-9]/)) {
                    valuesString.push([count++, string]);
                }
            });
        });
    });*/

  /*function move(index, hodnota) {
    let interval = null;
    let start_deg = 273;
    let end_deg = parseInt(hodnota) + start_deg;

    interval = setInterval(() => {
      if (start_deg !== end_deg) {
        start_deg++;
        graphs[valuesNumbers[index][0]].style.transform ="rotate(" + start_deg * 3.6 + "deg)";
      } else {
        clearInterval(interval);
      }
    }, 25);
  }*/

  //document.getElementById("percentil").innerText = valuesNumbers[4][1];

   /*let valuesGens = Array();
  d3.csv("csv/ol100.csv").then(function (data) {
    data.forEach((value) => {
      let result = Object.keys(value).map((key) => [Number(key), value[key]]);
      let splitValues = result[0][1].split(";");
      valuesGens.push(splitValues);
    });
  });

  let titles = [
    "Gen: ",
    "Číslo varianty: ",
    "Referenční alela: ",
    "Alternativní alela: ",
    "Genotyp: ",
    "Účinek alely: ",
    "Studie: ",
    "Popis genu: ",
  ];
  setTimeout(() => {
    valuesGens.forEach((selectedGen) => {
      let count = 0;
      let article = document.createElement("article");
      selectedGen.forEach((info) => {
        let infoDiv = document.createElement("div");
        infoDiv.innerText = titles[count++] + info;
        article.appendChild(infoDiv);
      });

      document.getElementById("gens").appendChild(article);
    });
  }, 100);*/
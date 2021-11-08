window.onload = () => {
  function date() {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, "0");
    let mm = String(today.getMonth() + 1).padStart(2, "0");
    let yyyy = today.getFullYear();

    today = dd + "/" + mm + "/" + yyyy;
    document.getElementById("date").innerText += today;
  }

  date();

  window.addEventListener("scroll", ()=> {
    window.scrollTo(0,0);
  });

  let id = document.getElementById("id").innerHTML;

  document.getElementById("download").addEventListener("click", () => {
    const grahps = this.document.getElementById("main");
    console.log(grahps);
    console.log(window);
    var opt = {
      margin: 0.5,
      filename: "VysledkyMereni-"+id+".pdf",
      image: { type: "jpeg", quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
    };
    html2pdf().from(grahps).set(opt).save();
  });
};
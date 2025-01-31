function juego(){
    let intento=prompt("introduce el número de tiradas que quieres jugar"); 
    let nombre1=prompt("introduce tu nombre:");
    let nombre2=prompt("introduce tu nombre:");
    alert("bienvenidos" +" " + nombre1 + " y " + nombre2);
    let acum1=0;
    let acum2=0;
    let contint=0;
    while(contint<intento){
        const dado1=Math.floor(Math.random() * 6)+ 1;
        alert(nombre1+ " te ha ha salido un... " + dado1);
        acum1=acum1+dado1;
        const dado2=Math.floor(Math.random() * 6)+ 1;
        alert(nombre2+ " te ha ha salido un... " +dado2);
        acum2=acum2+dado2;
        contint++;
}
    alert("el total de " +nombre1+ " puntos es:" +acum1);
    alert("el total de "+nombre2+" puntos es:  " +acum2);
    if(acum1>=acum2){
        alert("el ganador es "+nombre1 +" con "+ acum1 +" puntos");
    }else if (acum2>=acum1){
        alert("el ganador es "+nombre2+" con "+acum2+" puntos")
    }
}
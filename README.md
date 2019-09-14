 /* 
  * original green: #8bc34a;
  *
  * personale green: #67b868;
  *
  67b868
99eb97
35873c
000000
https://material.io/resources/color/#!/?view.left=0&view.right=0&primary.color=66b767
 */

:root {
  --main-bg-color: coral;
}

#div1 {
  background-color: var(--main-bg-color);
}

#div2 {
  background-color: var(--main-bg-color);
}

 body {
  min-height: 100vh;
  background: url(https://images.unsplash.com/photo-1539447535116-089d2cc362eb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1048&q=80) center / cover, linear-gradient(red,yellow);
  background-blend-mode: screen;
}

351773103256209 /01

351774103256207

OD24192317

5. Recortes
Ya no necesitamos Photoshop para recortar una imagen. Con la propiedad clip-path podemos dibujar figuras que recortarán la imagen. Lo mejor es que podemos animar esta propiedad y crear efectos muy vistosos.

.img {
  clip-path: circle(100px at center)
}

  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
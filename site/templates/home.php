<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php snippet('header') ?>
  </head>
  <body>
    <div id="app" class="left">
      <div class="square date push-left">
        Now Showing
      </div>
      <?php foreach($pages->find('films')->children() as $item): ?>
        <?php if ($item->featured()->toBool() === true): ?>
            <a style="text-decoration:none" href="<?= $item->url(); ?>">
        <?php endif ?>
      <?php endforeach ?>
        <div class="square watch color-block">
            <div class="watch-content">
              <h3 style="text-transform: none;">CiNEOLA Presents</h3>
              <?php foreach($pages->find('films')->children() as $item): ?>
                <?php if ($item->featured()->toBool() === true): ?>
                    <h1><?= $item->title(); ?></h1>
                <?php endif ?>
              <?php endforeach ?>
              <h3>Watch Now</h3>
            </div>
        </div>
      </a>
      <div @mouseover="hoverAbout = true"
           @mouseleave="hoverAbout = false"
           class="square about color-block">
        <div v-if="!hoverAbout" id = about-button>About</div>
        <div v-if="hoverAbout" id = about-text>
          <?= $pages->find('home')->aboutcineola()->kt(); ?>
        </div>
      </div>
      <div class="square logo push-right">
        <img src="<?php echo url('assets/img/cineola-logo.svg') ?>" alt="">
      </div>
      <div class="square email push-left">
        <form
        class="form validate"
        action="https://cineo.us8.list-manage.com/subscribe/post?u=60b50e59f99c5078b67ff4cbb&amp;id=acc3e72c0c"
        method="post"
        id="mc-embedded-subscribe-form"
        name="mc-embedded-subscribe-form"
        target="_blank"
        novalidate
        >
        <input type="text" value name="EMAIL" placeholder="EMAIL" required />
        <button id="mc-embedded-subscribe" class="btn" type="submit">
          SUBSCRIBE
        </button>
      </form>
      </div>
     <div @mouseover="hoverSocial = true"
          @mouseleave="hoverSocial = false"
          class="square about  color-block">
       <div v-if="!hoverSocial" id = about-button>Social</div>
       <div v-if="hoverSocial" class="social">
         <a target="_blank" href="https://www.instagram.com/cineolafilms/">Instagram</a>
         <a target="_blank" href="https://twitter.com/Cineola">Twitter</a>
         <a target="_blank" href="https://www.facebook.com/cineola">Facebook</a>
         <a target="_blank" href="https://www.youtube.com/channel/UCzRZKq7tACqMvl_aQXA3qrw">Youtube</a>
         <a target="_blank" href="https://open.spotify.com/show/4nZSKVjU21F7rks0aqW2Bm">Spotify</a>
       </div>
     </div>
    </div>
  </body>
</html>

<script>
  var app = new Vue({
    el: '#app',
    data: {
      hoverAbout: false,
      hoverSocial: false
    }
  })
</script>

<script>
  var color1;
  var color2;

  setInterval(changeColor(), 3000);

  function changeColor(){
  const root = document.documentElement;
  const colors = ['27c0ca', 'd19563', '1175b7', 'b7a37e', 'ac72d6', 'ddb54f', 'e9aee2', 'cfca57', 'f3604b', '7aab5b']

  randomNumbers()
  function randomNumbers() {
    const randomNumber1 = Math.floor(Math.random() * colors.length)
    const randomNumber2 = Math.floor(Math.random() * colors.length)
    if (randomNumber1 == randomNumber2) {
      randomNumbers()
    }
    else {
      color1 = colors[randomNumber1]
      color2 = colors[randomNumber2]
    }
  }
  root.style.setProperty('--color-primary', `#${color1}`)
  root.style.setProperty('--color-secondary', `#${color2}`)
  }
  // 3. Events
  window.setInterval(function(){
  changeColor()
  }, 10000);

  window.addEventListener('load', changeColor)
</script>

<style>
body {
  background-color: var(--color-primary);
  color: var(--cineola-black);
}

.color-block {
  background-color: var(--color-secondary);
}

.left {
  position: fixed;
  color: var(--cineola-black);
  display: grid;
  justify-content: center;
  align-content: center;
  grid-template-columns: repeat(2, 16.75vw);
  grid-template-rows: repeat(3, 15vw);
  width: 100%;
  height: 100%;
}
@media only screen and (max-width: 1024px) {
  .left {
    position: relative;
    color: var(--cineola-black);
    display: grid;
    grid-template-columns: repeat(2, 50%);
    grid-template-rows: repeat(3, calc(100vh / 3));
    width: 100%;
  }
}

  .square {
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Grotzec;
    text-transform: uppercase;
    font-size: var(--grotzec-text-size);
    font-weight: 100;
  }

  .push-left {
    transform: translateX(-50%);
  }

  .push-right {
    transform: translateX(50%);
  }
  @media only screen and (max-width: 1024px) {
    .push-left {
      transform: translateX(0%);
    }

    .push-right {
      transform: translateX(0%);
    }
  }

  .date {
    font-family: Nayarit;
    text-transform: none !important;
    font-size: 5vw;
  }
  @media only screen and (max-width: 1024px) {
    .date {
      font-size: 3em;
    }
  }

  .watch {
    background-image: url(<?php echo $pages->find('films')->children()->first()->cover()->toFile()->url() ?>);
    background-size: cover;
    background-position: center;
    box-shadow: inset 0 0 0 1000px  var(--color-secondary);
    height: 100%;
  }

  .watch a {
    height: 100%;
    display: flex;
  }

  .watch-content {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    height: 100%;
  }

  .watch h1 {
    text-transform: none;
    text-align: center;
    font-family: nayarit;
    font-size: 3em;
  }
  @media only screen and (max-width: 1024px) {
    .watch h3 {
      font-size: var(--mobile-text-size);
    }
    .watch h1 {
      /* font-size: 12.5vh; */
    }
  }

  .logo img {
    width: 100%;
  }
  @media only screen and (max-width: 1024px) {
    .logo img {
      width: 80%;
    }
  }

  #about-text {
    width: 92.5%;
    text-transform: none !important;
  }
  @media only screen and (max-width: 1024px) {
    .about {
      font-size: var(--mobile-text-size);
    }
  }

  .social {
    display: flex;
    height: 75%;
    align-items: center;
    flex-direction: column;
    justify-content: space-between;
  }

  @media only screen and (max-width: 1024px) {
    .social {
      flex-direction: column;
      font-size: var(--mobile-text-size);
    }
  }

  /**** FORM ****/
  .form {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  @media only screen and (max-width: 1024px) {
    .form {
      flex-direction: row;
      width: 80%;
    }
  }

  input {
    width: 8vw;
    font-size: var(--grotzec-text-size);
    font-family: Grotzec;
    font-weight: 100;
    padding: 1vw;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0;
    border: 1px solid #232323;
    outline: none;
    color: var(--cineola-black);
    background-color: transparent;
  }
  @media only screen and (max-width: 1024px) {
    input {
      width: 100%;
      font-size: var(--mobile-text-size);
    }
  }

  /* Change autocomplete styles in WebKit */
  input:-webkit-autofill,
  input:-webkit-autofill:hover,
  input:-webkit-autofill:focus,
  textarea:-webkit-autofill,
  textarea:-webkit-autofill:hover,
  textarea:-webkit-autofill:focus,
  select:-webkit-autofill,
  select:-webkit-autofill:hover,
  select:-webkit-autofill:focus {
    border: 1px solid #232323;
    -webkit-text-fill-color: #232323;
    -webkit-box-shadow: 0 0 0px 1000px transparent inset;
    transition: background-color 5000s ease-in-out 0s;
  }

::placeholder {
  color: var(--cineola-black);
  opacity: 1; /* Firefox */
}

.btn {
    width: 5.5vw;
    color: var(--color-primary);
    display: flex;
    justify-content: center;
    font-size: var(--grotzec-text-size);
    font-family: Grotzec;
    padding: 1vw;
    border: 1px solid #232323;
    border-left: 0px;
    cursor: pointer;
    background-color: #232323;
    outline: none;
}
@media only screen and (max-width: 1024px) {
  .btn {
    width: 100%;
    font-size: var(--mobile-text-size);
  }
}

.btn:hover {
  text-decoration: underline;
}
/**** END FORM ****/

</style>

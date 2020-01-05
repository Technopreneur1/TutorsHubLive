<template>
    <div class="full-pop">
        <div class='loader'>
            <div class='spinner yellow'></div>
            <div class='spinner orange'></div>
            <div class='spinner red'></div>
            <div class='spinner pink'></div>
            <div class='spinner violet'></div>
            <div class='spinner mauve'></div>
            <div class='spinner light-yellow'></div>
        </div>

    </div>
</template>
<script>
    export default {
        data()
        {
           return{
                
           }
        },
        
    }
</script>
<style lang="css" scoped>
.full-pop {
  position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #1950808c;
    z-index: 10;
}

.loader {
  display: block;
  width: 100px;
  height: 100px;
  position: relative;
  transform-origin: 63px 63px;
  animation: spin 1s infinite linear;
}
.loader .spinner {
  display: block;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  position: absolute;
  z-index: 99;
  top: 0;
  left: 0;
  border-width: 0px 0px 26px 26px;
  border-style: solid;
  border-color: transparent;
}
.loader .spinner.yellow {
  border-left-color: #317254;
}
.loader .spinner.orange {
  border-left-color: #469a85;
  transform: rotate(-45deg);
}
.loader .spinner.red {
  border-left-color: #66ff87;
  transform: rotate(-90deg);
}
.loader .spinner.pink {
  border-left-color: #1f4f51;
  transform: rotate(-135deg);
}
.loader .spinner.violet {
  border-left-color: #327455;
  transform: rotate(-180deg);
}
.loader .spinner.mauve {
  border-left-color: #2e6b54;
  transform: rotate(-225deg);
}
.loader .spinner.light-yellow {
  border-left-color: #469a85;
  transform: rotate(-270deg);
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(-360deg);
  }
}

</style>
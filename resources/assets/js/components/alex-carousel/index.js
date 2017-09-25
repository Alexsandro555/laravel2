import Carousel from "./Carousel.vue"
import Slide from "./Slide.vue"

const install = (Vue) => {
  Vue.component("alex-carousel", Carousel)
  Vue.component("alex-slide", Slide)
}

export default {
  install,
}

export {
  Carousel,
  Slide
}

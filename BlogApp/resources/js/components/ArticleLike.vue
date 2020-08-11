<template>
  <div>
      <label class="like">
        <input type="checkbox">
        <i class="fas fa-heart heart mr-1"
        :class="{'text-danger':this.isLikedBy}"
        @click="clickLike">
        </i>
      </label>
    {{ countLikes }}
  </div>
</template>

<style>
    .like [type="checkbox"] {
      display: none;
    }

    .heart {
        color: #e4e4e4;
        cursor: pointer;
        user-select: none;
    }

    .like [type="checkbox"]:checked ~ .heart {
      animation-name: heart;
      animation-duration: .6s;
      animation-fill-mode: forwards;
    }

    @keyframes heart {
      0% {
        transform: scale(0);
      }
      50% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
        color: red;
      }
    }
</style>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
      }
    },
    methods: {
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true
        this.countLikes = response.data.countLikes
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
      },
    },
  }
</script>
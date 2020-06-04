<template>
    <span>
        <i
            class="fa ml-2"
            :class="[isLiked ? 'fa-heart text-danger' : 'fa-heart-o']"
            style="user-select: none"
            :style="[isLoggedIn ? { cursor: 'pointer' } : '']"
            aria-hidden="true"
            @click.prevent="likeClick"
        />
        {{ count }}
    </span>
</template>

<script type="application/javascript">
export default {
    props: {
        liked: {
            type: Boolean,
            required: true
        },
        likesCount: {
            type: Number,
            required: true
        },
        itemType: {
            type: String,
            required: true
        },
        itemId: {
            type: Number,
            required: true
        },
        loggedIn: {
            type: Boolean,
            required: true
        },
        userId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            isLiked: this.liked,
            isLoggedIn: this.loggedIn,
            count: this.likesCount,
            isLoading: false,
            api_token: this.apiToken
        }
    },
    methods: {
        likeClick() {
            if(this.isLoading || !this.isLoggedIn) {
                return;
            }

            if(this.isLiked) {
                return this.dislike();
            }
            return this.like();
        },

        like() {
            this.isLoading = true;
            axios.post(`/api/${this.itemType}/${this.itemId}/likes`, {
                userId: this.userId
            })
            .then(response => {
                this.isLoading = false;
                this.isLiked = true;
                this.count++;
            }).catch((error) => {
                console.log(error);
                this.isLoading = false;
            });
        },

        dislike() {
            this.isLoading = true;
            axios.delete(`/api/${this.itemType}/${this.itemId}/dislike`, {
                userId: this.userId
            }).then(response => {
                this.isLoading = false;
                this.isLiked = false;
                this.count--;
            }).catch((error) => {
                console.log(error);
                this.isLoading = false;
            });
        }

    }
}
</script>

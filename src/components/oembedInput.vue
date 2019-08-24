<script>
export default {
    extends: 'k-url-input',
    methods: {
        onInput(value) {
            if(!this.isUrl(value)) return;
            this.$api
                .get('kirby-oembed/get-data', { url: value })
                .then(response => {
                    if(response['status'] == 'success' && response['data']) {
                        this.media = response['data']
                    }
                    else {
                        this.media = {}
                    }

                    this.emitInput(value)
                })
                .catch(error => {
                    this.media = {}
                    this.emitInput(value)
                })
        },
        emitInput(value) {
            this.$emit("input", {
                input: value ? value : '',
                media: this.media
            });
            this.$emit("setMedia", this.media)
        },
        isUrl(value) {
          const pattern = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g
          const regex = new RegExp(pattern)
          return !value || value.match(regex)
        }
    }
};
</script>

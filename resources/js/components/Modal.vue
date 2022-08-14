<template>
    <transition name="modal-trans">
        <div v-bind:class="{ 'modal': true, 'd-block show': this.show }" v-show="this.show" v-on:click.self.prevent="close">
            <div v-bind:class="{ 'modal-dialog modal-dialog-centered': true, [`modal-${size}`]: !!size }">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" aria-label="Close" v-on:click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            <p>Modal body text goes here.</p>
                        </slot>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <slot name="footer-left">
                                <button type="button" class="btn btn-secondary" v-on:click="close">Close</button>
                            </slot>
                        </div>
                        <div>
                            <slot name="footer-right">
                                <button type="button" class="btn btn-primary" v-on:click="save">
                                    <slot name="footer-save-text">Save changes</slot>
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<style>
.modal {
    background: rgba(0, 0, 0, .5);
    transition: all .3s ease;
}

.modal-dialog {
    transition: all .3s ease;
}

.modal-trans-enter {
    opacity: 0;
}

.modal-trans-leave-active {
    opacity: 0;
}

.modal-trans-enter .modal-dialog,
.modal-trans-leave-active .modal-dialog {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>

<script>
export default {
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: null,
        },
        validated: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        save() {
            if (this.validated) {
                for (const e of Array.from(this.$parent.$el.querySelectorAll('input, select'))) {
                    if (!e.checkValidity()) {
                        e.reportValidity();
                        return;
                    }
                }
            }

            this.$emit('save');
            this.close();
        },
    },
    watch: {
        show: {
            immediate: true,
            handler() {
                document.querySelector('body').classList.toggle('modal-open', this.show);
            },
        },
    },
};
</script>

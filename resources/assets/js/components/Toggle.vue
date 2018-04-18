<template>
	<div>
		<span class="toggle-wrapper" @click="toggle"
		      role="checkbox"
		      :aria-checked="value.toString()"
		      tabindex="0"
		      @keydown.space.prevent="toggle">
	        <span class="toggle-background testing" :style="backgroundStyles" value="Pick-up"></span>
	        <span class="toggle-indicator testing" :style="indicatorStyles" value="Delivery"></span>
	    </span>
	    <div class="col-md-6">
            <div class="pickup-time form-group">
                <label for="pickup-time">Pick-up hour (11am to 10pm, 24hr format)</label>
                <input type="time"
                        class="form-control"
                        min="1200"
                        max="2200"
                        v-bind:value="1700"
                        required
                        name="pickup_time"
                        v-if="checked">
                <span class="validity"></span>
            </div>
        </div>
	</div>
</template>

<script>
    export default {
		props: ['value'],

		data() {
			return {
				checked: this.value
			}
		},

	    methods: {
	        toggle(e) {
	            this.$emit('input', !this.value, this.checked = !this.checked);
	        }
	    },

	    computed: {
	        backgroundStyles() {
	            return {
	      	        backgroundColor: this.value ? '#3490dc' : '#dae1e7'
	            }
	        },
	        indicatorStyles() {
	            return {
	            	transform: this.value ? 'translateX(2rem)' : 'translateX(0)'
            	}
	        }
	    }
    }

</script>

<style scoped>

.toggle-wrapper {
	display: inline-block;
	position: relative;
	cursor: pointer;
	height: 2rem;
	width: 4rem;
	border-radius: 9999px;
}
.toggle-wrapper:focus {
	outline: 0;
	box-shadow: 0 0 0 4px rgba(52,144,220,.5);
}

.toggle-wrapper:before {
	content: 'Delivery';
	position: absolute;
	right: 30px;
}

.toggle-wrapper:after {
	content: 'Pick-up';
	position: absolute;
	left: 30px;
}

.toggle-background {
	display: inline-block;
	border-radius: 9999px;
	height: 100%;
	width: 100%;
	box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
	transition: background-color .2s ease;
}

.toggle-indicator {
	position: absolute;
	top: .25rem;
	left: .25rem;
	height: 1.5rem;
	width: 1.5rem;
	background-color: #fff;
	border-radius: 9999px;
	box-shadow:  0 2px 4px rgba(0,0,0,0.1);
	transition: transform .2s ease;
}
</style>
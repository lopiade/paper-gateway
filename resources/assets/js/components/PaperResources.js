// imports
import PaperResource from './PaperResource';
/**
 * @module PaperResources
 *
 */
export default {

    name: 'PaperResources',

    template: require('./templates/paper-resources.html'),

    components: {
        PaperResource
    },

    data: function () {
        return {

            resources: [],

            loading: false,
            processing: false
        }
    },

    /**
     *  Component methods
     */
    methods: {

        initResources() {

            if (resources instanceof Array) {

                resources.map( item => {

                    this.resources.push({
                        status: 'pending',
                        online: false,
                        context: item
                    })
                });
            } else {

                console.log(' is not array ')
            }

            // weiter im text

        }


    },

    /**
     *  Component is rendered
     */
    ready: function () {

        this.initResources();

        // console.log(this.resources);
    }

};
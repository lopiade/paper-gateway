/**
 * @module PaperResource
 *
 */
export default {

    name: 'PaperResource',

    template: require('./templates/paper-resource.html'),

    props: ['resource'],

    data: function () {
        return {
            loading: false,
            processing: false
        }
    },

    computed: {

        statusClass() {

            if ( this.loading || ! this.resource.context.active) {
                return 'resource-inactive';
            }

            if ( ! this.loading) {
                return this.resource.online ? 'list-group-item-success' : 'list-group-item-danger';
            }
        },

        clickable() {
            
            return this._resourceIsClickable() ? 'cursor: pointer' : '';
        },

        onlineLabel() {
          
            if (! this.resource.context.active) return 'This link is currently inactive.';
            
            if (this.resource.online ) {
                return 'Online.'
            } else {
                return 'Currently not available.'
            }
        },

        onlineIcon() {
            switch (this.resource.context.type) {
                case 'original':
                    return 'fa-globe';
                
                case 'mirror':
                    return 'fa-clone';
                
                case 'local':
                    return 'fa-cloud-download';
            }
            return 'fa-link';
        }

    },

    /**
     *  Component methods
     */
    methods: {

        initStatus() {

            switch(this.resource.context.online) {

                case 0: // 0 = auto

                    if (this.resource.context.active) {
                        this.checkAvailability();
                    } else {
                        this.resource.status = 'success';
                        this.resource.online = true;
                    }
                    break;

                case 1: // 1 = online
                    // not check
                    this.resource.status = 'success';
                    this.resource.online = true;
                    break;

                case 2: // 2 = offline
                    // not check
                    this.resource.status = 'success';
                    this.resource.online = false;
                    break;

                default:
                    this.checkAvailability();
                    break;
            }

        },

        /**
         * Check availability
         */
        checkAvailability() {

            this.loading = true;

            let resource = this.$resource('/api/resource{/id}');

            resource.save({id: this.resource.context.id},{}).then(response => {

                this.resource.status = 'success';
                this.resource.online = response.data.is_online;

            }, () => {

                this.resource.status = 'failed';

            }).finally(() => {
                this.loading = false;
            });
        },

        /**
         * onClick event: resource (link out)
         */
        onClickResource() {

            if (! this._resourceIsClickable() ) return;

            window.open( this.resource.context.url,'_blank');
        },

        /**
         * Check if resource is clickable
         *
         * @returns {boolean|number|active|Function|Array|*}
         * @private
         */
        _resourceIsClickable()
        {
            return !! this.resource.online && this.resource.context.active;
        }

    },

    /**
     *  Component is rendered
     */
    ready: function () {

        this.initStatus();
    }

};
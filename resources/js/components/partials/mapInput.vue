<template>
    <div class="wrapper">
        <div class="box-title" for="location">Locations Settings</div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <gmap-autocomplete class="form-control" @place_changed="setPlace"></gmap-autocomplete>
            </div>
        </div>
        <br>
        <!-- <button @click="usePlace">Add</button> -->
        <GmapMap :center="location" :zoom="12" style="width: 100%; height: 400px">
            <GmapMarker
                :position="location"
                :clickable="true"
                :draggable="true"
                @click="center = location"
                @place_changed="setPlace"
                @position_changed="marketDrag"
            />
        </GmapMap>
        <br>
        <div class="text-right">
            <button @click="post()" class="btn btn-success">Update</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ulat', 'ulng'],
        data()
        {
            return {
                location: {
                    lat: 40.7831,
                    lng: -73.9712
                },
                markets: [{
                    position: {lat: 40.7831, lng:-73.9712}
                }]
            }
        },
        methods: {
            setPlace(place)
            {
                console.log(place)
                this.location = {
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng(),
                    formatted_address: place.formatted_address
                }
            },
            marketDrag(position)
            {
                this.location.lat = position.lat(),
                this.location.lng = position.lng()

                const geocoder = new google.maps.Geocoder()
                geocoder.geocode({ 'latLng': position }, (result, status) => {
                    if (status === google.maps.GeocoderStatus.OK) {
                        // set the input field value with address:
                        console.log(result[0].formatted_address)
                        this.location.formatted_address = result[0].formatted_address;
                    }
                })
            },
            post()
            {
                axios.post('/update/long-lat', {lat: this.location.lat, lng: this.location.lng, address: this.location.formatted_address})
                    .then(response => {
                        //    alert("Updated");
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Location has been updated',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getLocation()
            {
                if(this.ulat && this.ulng)
                {
                    this.location.lat = parseFloat(this.ulat)
                    this.location.lng = parseFloat(this.ulng)
                }else{
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(this.showPosition);
                    }
                }
                //    console.log('getloc')
            },
            showPosition(position) {
                this.location.lat = position.coords.latitude
                this.location.lng = position.coords.longitude
            }
        },
        mounted(){

            this.getLocation()

        }

    }
</script>

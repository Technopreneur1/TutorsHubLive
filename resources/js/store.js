export default {
    state: {
      notifications: [],
      sessions: "2",
      messages: "0",
      paypal: "",
      bank: ""
    },
    mutations: {
      setCart (state, payload) {
        console.log('working')
        state.cartCount = payload
      },
      setNotifications (state, payload) {
        state.notifications = payload
      },
      setPaypal (state, payload) {
        state.paypal = payload
      },
      setBank (state, payload) {
        state.bank = payload
      },
      setSessions (state, payload) {
        state.sessions = payload
      },
      decreseSessions (state, payload) {
        if(state.sessions > 0)
        {
          state.sessions--
        }
      },
      setMessages (state, payload) {
        state.messages = payload
      },
      addNotification (state, payload) {
        state.notifications.push(payload)
      },
      incrementCart (state, items) {
        state.count += items
      }
    },
    getters: {
      notifications: state => {
        return state.notifications
      },
      sessions: state => {
        return state.sessions
      },
      messages: state => {
        return state.messages
      },
      paypal: state => {
        return state.paypal
      },
      bank: state => {
        return state.bank
      }
    },
  }
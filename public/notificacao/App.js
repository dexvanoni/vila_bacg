import { Notifyer } from '/notificacao/Notifyer.js';
//import { Timer } from '/notificacao/Timer.js';
import { Emitter } from '/notificacao/Emitter.js';

const notify = Notifyer.notify({
  title: "NOVA OCORRÊNCIA LANÇADA",
  body: "Teste"
})

const notify = Notifyer.notify({
  title: "NOVA OCORRÊNCIA LANÇADA",
  body: "Teste"
})

const App = {
  async start() {
   try {
     await Notifyer.init()

    Emitter.on('countdown-start', notify)
    Emitter.on('countdown-end', Timer.init)
    
    Timer.init()
   } catch (err) {
     console.log(err.message)
   }
  }
}

export { App }
import { Navbar, Welcome, Footer, Services, Transactions } from "./components";
import Status from "./Status";
const App = () => (
  <div className="min-h-screen">
    <div className="gradient-bg-welcome">
      <Navbar />
      <Welcome />
    </div>
    <Services />
    <Transactions />
    <Footer />
    <Status />
  </div>
);

export default App;

import { useState, useCallback, useEffect, useRef } from 'react'
import './App.css'

function App() {
  const [length, setlength] = useState(6);
  const [numAllowed, setNumAllowed]= useState(false);
  const [charAllowed, setCharAllowed] = useState(false);
  const [password, setPassword] = useState("");

  // useRef Hook
  // this hook is used for taking reference of any element or value
  const passwordRef = useRef(null);

  // Password Generator
  // useCallback is a React Hook that lets you cache a function definition between re-renders.
//   Skipping re-rendering of components
// Updating state from a memoized callback
// Preventing an Effect from firing too often
// Optimizing a custom Hook
  const passwordGenerator = useCallback(()=>{
    let pass = "";
    let str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    if(numAllowed) str += "0123456789";
    if(charAllowed) str+= "!@#$%^&*()~-_{}`+=";
    for(let i = 1; i <= length; i++){
      let char = Math.floor(Math.random()* str.length +1);
      pass += str.charAt(char);
    }
    setPassword(pass);

  },[length, numAllowed, charAllowed, setPassword])

  const copyPasswordToClipboard = useCallback(()=>{
    passwordRef.current?.select();
    // To Select the specific Range of the text
    passwordRef.current?.setSelectionRange(0, 8);
    window.navigator.clipboard.writeText(password);
  }, [password])

  // useEffect is a React Hook that lets you run some side-effect (like API calls, setting timers, etc.) when a component mounts or updates.

  useEffect(()=>{
    passwordGenerator();
  }, [length, numAllowed, charAllowed, passwordGenerator])
  return (
    <>
      <div className="w-full max-w-md mx-auto shadow-md rounded-lg px-4 py-3 my-8 text-orange-600 bg-gray-700">
        <h1 className="text-white text-center mb-3">Password Generator</h1>
        <div className="flex shadow-lg rounded-md overflow-hidden mb-4">
          <input 
          type="text" 
          className="bg-white outline-none w-full py-1 px-3 rounded-md" 
          value={password}
          placeholder="password"
          readOnly
          ref={passwordRef}

          />
          <button 
          onClick={copyPasswordToClipboard}
          className="px-4 py-2 bg-blue-600 text-white shrink-0 hover:bg-blue-500 active:bg-blue-950">Copy</button>
        </div>
        <div className="flex text-sm gap-x-2">
          <div className="flex items-center gap-x-1 ">
            <input type="range" 
            
            className="cursor-pointer w-20"
            min = {6}
            max = {100}
            value = {length}
            onChange={(e)=>setlength(e.target.value)}
            id ="length"
            />
            <label htmlFor="length" className='text-white'>Length({length})</label>
          </div>
          <div className="flex items-center gap-x-1 ">
            <input type="checkbox" 
            className="cursor-pointer "
            defaultChecked = {numAllowed}
            
            onChange={()=>setNumAllowed((prev)=>!prev)}
            id ="numInput"
            />
            <label htmlFor="numInput" className='text-white'>Numbers</label>
          </div>
          <div className="flex items-center gap-x-1 ">
            <input type="checkbox" 
            className="cursor-pointer "
            defaultChecked = {charAllowed}
            onChange={()=>setCharAllowed((prev)=>!prev)}
            id ="charInput"
            />
            <label htmlFor="charInput" className='text-white'>Characters</label>
          </div>
        </div>
      </div>
    </>
  )
}

export default App

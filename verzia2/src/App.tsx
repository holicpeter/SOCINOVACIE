import React, { useState, useEffect } from 'react'
import { Routes, Route } from 'react-router-dom'
import { motion, AnimatePresence } from 'framer-motion'
import Header from './components/Header'
import Navigation from './components/Navigation'
import Hero from './components/Hero'
import AboutSection from './components/AboutSection'
import InnovationAreas from './components/InnovationAreas'
import NewsSection from './components/NewsSection'
import Footer from './components/Footer'
import SkipLink from './components/SkipLink'
import LoadingSpinner from './components/LoadingSpinner'

function App() {
  const [isLoading, setIsLoading] = useState(true)
  const [announcement, setAnnouncement] = useState('')

  useEffect(() => {
    // Simulate initial loading
    const timer = setTimeout(() => {
      setIsLoading(false)
    }, 1500)

    return () => clearTimeout(timer)
  }, [])

  // Function for screen reader announcements
  const announceToScreenReader = (message: string) => {
    setAnnouncement(message)
    setTimeout(() => setAnnouncement(''), 1000)
  }

  if (isLoading) {
    return <LoadingSpinner />
  }

  return (
    <div className="min-h-screen flex flex-col">
      <SkipLink />
      
      {/* Live region for screen reader announcements */}
      <div 
        aria-live="polite" 
        aria-atomic="true" 
        className="sr-only"
        role="status"
      >
        {announcement}
      </div>

      <Header />
      <Navigation />
      
      <AnimatePresence mode="wait">
        <Routes>
          <Route 
            path="/" 
            element={
              <motion.main
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 0.3 }}
                id="main-content"
                className="flex-1"
              >
                <Hero />
                <div className="container mx-auto px-4 py-8">
                  <AboutSection />
                  <InnovationAreas announceUpdate={announceToScreenReader} />
                  <NewsSection />
                </div>
              </motion.main>
            } 
          />
          {/* Add more routes as needed */}
        </Routes>
      </AnimatePresence>

      <Footer />
    </div>
  )
}

export default App

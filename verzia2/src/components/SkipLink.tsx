import React from 'react'

const SkipLink: React.FC = () => {
  return (
    <a
      href="#main-content"
      className="skip-link"
      onFocus={(e) => e.target.scrollIntoView()}
    >
      Preskočiť na hlavný obsah
    </a>
  )
}

export default SkipLink

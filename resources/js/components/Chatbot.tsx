
import { Button } from "@/components/ui/button"
import { motion } from "framer-motion"
import { AnimatePresence } from 'framer-motion'
import { ArrowDownCircleIcon, HeadsetIcon, SendIcon, SquareIcon, X } from 'lucide-react'
import React, { useEffect, useRef, useState } from 'react'
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "./ui/card"
import { ScrollArea } from "./ui/scroll-area"
import { useChat } from "@ai-sdk/react"
import ReactMarkdown from 'react-markdown'
import remarkGfm from 'remark-gfm'
import axios from 'axios'

export default function Chatbot() {
    const [isChatOpen, setisChatOpen] = useState(false)
    const [showChatIcon, setshowChatIcon] = useState(true)
    const chaticonref = useRef(null)
    const [language, setLanguage] = useState<string | null>(null)
    const [awaitingLanguage, setAwaitingLanguage] = useState(true)
    const [responseerror, setResponseerror] = useState(false)

    const { messages, input, handleInputChange, handleSubmit, isLoading, stop, error, append } = useChat({ api: '/api/gemini' })

    const fetchLastGeminiResponse = async () => {
        setResponseerror(false)
        try {
            const response = await axios.get('/api/gemini/last')

            if (response.data?.content) {
                append({
                    role: 'assistant',
                    content: response.data.content
                })
                setResponseerror(false)
            }
        } catch (err) {
            setResponseerror(true)
            console.error(err)
        }
    }

    const customHandleSubmit = async (e: React.FormEvent) => {
        e.preventDefault()
        setResponseerror(false)

        if (input.trim() === '') return

        await handleSubmit(e)

        setTimeout(async () => {
            await fetchLastGeminiResponse()
        }, 2000);
    }

    const tooglechat = () => {
        setisChatOpen(!isChatOpen)
    }

    const scrollref = useRef<HTMLDivElement | null>(null)

    const handleLanguageSelect = async (selectedLanguage: any) => {
        setLanguage(selectedLanguage);
        setAwaitingLanguage(false);

        await append({
            role: 'system',
            content: `LANGUAGE:${selectedLanguage}`,
        });

        fetchLastGeminiResponse()
    }

    useEffect(() => {
        if (scrollref.current) {
            scrollref.current.scrollIntoView({ behavior: 'smooth' })
        }
    }, [messages])

    return (
        <>
            <style>
                {`
                    .chat-button-custom {
                        bottom: 4rem;
                        right: 3rem !important;
                    }

                    @media (min-width: 768px) {
                        .chat-button-custom {
                            bottom: 3rem;
                            right: 2rem !important;
                        }
                    }
                `}
            </style>
            {/* Chat Icon */}
            <AnimatePresence>
                {showChatIcon && (
                    <motion.div
                        initial={{ opacity: 0, y: 100 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: 100 }}
                        transition={{ duration: 0.2 }}
                        className="position-fixed chat-button-custom"
                        style={{zIndex: 50 }}
                        onClick={tooglechat}
                    >
                        <Button ref={chaticonref} title="Chat" onClick={tooglechat} size="icon" className="rounded-circle shadow-lg p-2"
                            style={{ width: '3.5rem', height: '3.5rem' }}>
                            {!isChatOpen ? (
                                <HeadsetIcon style={{ width: '2rem', height: '2rem' }} className="text-white" />
                            ) : (
                                <ArrowDownCircleIcon className="text-white" />
                            )}
                        </Button>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Black Overlay */}
            <AnimatePresence>
                {isChatOpen && (
                    <motion.div
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        exit={{ opacity: 0 }}
                        transition={{ duration: 0.2 }}
                        className="position-fixed w-100 h-100"
                        style={{ top: 0, left: 0, zIndex: 40, backgroundColor: 'rgba(0, 0, 0, 0.3)', backdropFilter: 'blur(4px)' }}
                        onClick={tooglechat}
                    />
                )}
            </AnimatePresence>

            {/* Chat Window */}
            <AnimatePresence>
                {isChatOpen && (
                    <motion.div
                        initial={{ opacity: 0, scale: 0.8 }}
                        animate={{ opacity: 1, scale: 1 }}
                        exit={{ opacity: 0, scale: 0.8 }}
                        transition={{ duration: 0.2 }}
                        className="position-fixed"
                        style={{ bottom: '7rem', right: '2rem', zIndex: 50, width: '90%', maxWidth: '500px' }}
                    >
                        <Card style={{ borderRadius: "0.75rem" }}>
                            <CardHeader className="d-flex justify-content-between align-items-center pb-3 p-4">
                                <CardTitle className="h5 font-weight-bold">
                                    <h4 style={{ fontWeight: 'bold' }}>Chat with Surfside Media</h4>
                                </CardTitle>
                                <Button onClick={tooglechat} size="sm" variant="ghost" className="px-2 py-0" style={{ border: 'none', backgroundColor: 'transparent' }}>
                                    <X className="w-1rem h-1rem" />
                                    <span className="visually-hidden">Close Chat</span>
                                </Button>
                            </CardHeader>
                            {awaitingLanguage && (
                                <CardContent className="p-0">
                                    <ScrollArea className="px-3" style={{ height: '300px' }}>
                                        <div className="d-flex flex-column align-items-center justify-content-center p-4">
                                            <div className="text-center h5 mb-4">
                                                Please select your language:
                                            </div>
                                            <div className="d-flex gap-4">
                                                <Button
                                                    onClick={() => handleLanguageSelect('english')}
                                                    className="px-4 py-2 btn btn-dark">
                                                    English
                                                </Button>
                                                <Button
                                                    onClick={() => handleLanguageSelect('hindi')}
                                                    className="px-4 py-2 btn btn-dark">
                                                    Hindi
                                                </Button>
                                            </div>

                                        </div>
                                    </ScrollArea>
                                </CardContent>
                            )}
                            {!awaitingLanguage && (
                                <>
                                    <CardContent className="p-0">
                                        <ScrollArea className="px-5" style={{ height: '300px', overflow: 'auto' }}>
                                            {messages?.length === 0 && (
                                                <div
                                                    className="d-flex justify-content-center align-items-center w-100 text-secondary gap-3"
                                                    style={{ marginTop: '8rem' }}
                                                >
                                                    No Messages Yet
                                                </div>
                                            )}
                                            {messages?.map((message, index) => {
                                                if (message.role === 'system' && message.content.startsWith('LANGUAGE:')) {
                                                    return null;
                                                }
                                                return (
                                                    <div key={index} className={`mb-4 ${message.role == "user" ? "text-right" : "text-left"}`}>
                                                        <div className={`d-inline-block p-3 ${message.role == "user" ? "bg-secondary" : "bg-primary text-white"} `} style={{ borderRadius: '0.75rem' }}>
                                                            <ReactMarkdown children={message.content} remarkPlugins={[remarkGfm]} components={{
                                                                code({ node, inline, className, children, ...props }: any) {
                                                                    return inline ? (
                                                                        <code {...props} className="bg-light p-1 rounded">
                                                                            <h6 className="text-white mb-0">{children}</h6>
                                                                        </code>
                                                                    ) : (
                                                                        <pre className="bg-light p-2 rounded">
                                                                            <code {...props}>
                                                                                <h6 className="text-white mb-0">{children}</h6>
                                                                            </code>
                                                                        </pre>
                                                                    )
                                                                },

                                                                p: ({ children }) => (
                                                                    <p className="mb-0 text-white">{children}</p>
                                                                ),

                                                                ul: ({ children }) => (
                                                                    <ul className="list-unstyled ms-4 text-white">
                                                                        {children}
                                                                    </ul>
                                                                ),

                                                                ol: ({ children }) => (
                                                                    <ol className="list-unstyled ms-4 text-white">
                                                                        {children}
                                                                    </ol>
                                                                ),

                                                                a: ({ href, children }) => (
                                                                    <a href={href} className="text-white" rel="noopener noreferrer" style={{ textDecoration: 'underline' }}>
                                                                        <strong>{children}</strong>
                                                                    </a>
                                                                )
                                                            }} >
                                                            </ReactMarkdown>
                                                        </div>
                                                    </div>
                                                )
                                            })}
                                            {isLoading && (
                                                <div className="d-flex justify-content-start align-items-center gap-2 mb-3 mt-2">
                                                    <h6>Typing...</h6>
                                                    <span className="spinner-border spinner-border-sm text-primary" role="status" style={{ animationDelay: '0s' }}></span>
                                                </div>
                                            )}
                                            {responseerror && (
                                                <div className="w-full align-items-center d-flex justify-content-center gap-3 mb-10">
                                                    <div><h5>An error occured</h5></div>
                                                    <Button title="Retry" onClick={() => fetchLastGeminiResponse()} style={{
                                                        borderRadius: '0.75rem', color: 'white', textDecoration: 'underline'
                                                    }}>Retry..</Button>
                                                </div>
                                            )}
                                            <div ref={scrollref}></div>
                                        </ScrollArea>
                                    </CardContent>
                                    <CardFooter className="p-4 pt-3">
                                        <form onSubmit={customHandleSubmit} className="d-flex w-full align-items-center mx-2 gap-2">
                                            <input value={input} onChange={handleInputChange} className="form-control" placeholder="Type Your Message Here..." style={{ height: '2.5rem', borderRadius: '0.75rem' }} />
                                            {isLoading ? (
                                                <Button title="Stop" type="submit" style={{ width: '2.25rem', height: '2.25rem', borderRadius: '0.75rem' }} size="icon" onClick={() => stop()}>
                                                    <SquareIcon className="text-white" width={16} height={16} />
                                                </Button>
                                            ) : (
                                                <Button title="Send" type="submit" style={{ width: '2.25rem', height: '2.25rem', borderRadius: '0.75rem' }} disabled={isLoading} size="icon">
                                                    <SendIcon className="text-white" width={16} height={16} />
                                                </Button>
                                            )}
                                        </form>
                                    </CardFooter>
                                </>
                            )}
                        </Card>
                    </motion.div>
                )}
            </AnimatePresence>
        </>
    )
}

                <!-- Confirmation Dialog Box -->
                <form id="confirmationDialog" class="fixed inset-0 bg-slate-900/50 dark:bg-black/80 flex items-center justify-center hidden z-20">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl shadow-lg w-80">
                        <div id="dialogImage" class="w-full h-48 checkboard mb-4 rounded-xl relative overflow-hidden hidden" data-src="<?= $updir ?>">
                            <img src="" alt="" class="w-full h-full object-contain object-center" />
                            <p class="font-medium text-xs md:text-sm absolute top-0 left-0 m-2 py-1 px-3 rounded-full bg-blue-500 dark:bg-blue-300 text-white dark:text-slate-900" id="dialogBadge">Previous Logo</p>
                        </div>
                        <h3 class="text-lg font-semibold">Confirm Action</h3>
                        <p id="dialogMessage" class="mt-2 opacity-80 text-sm"></p>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button type="button" title="Dismiss action" id="cancelButton" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                                Dismiss
                            </button>
                            <button type="submit" title="Confirm action" id="confirmButton" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                                Confirm
                            </button>
                        </div>
                    </div>
                </form>
                </section>
                </main>

                </body>

                </html>